<?php

	require_once("../inc/init.inc.php");

	require_once("../inc/haut.inc.php");

	//debug($_SESSION);

	$requestCategories = "SELECT * FROM categorie";
	$resultCategories = $pdo->query($requestCategories);

	$infoscategories = $resultCategories->fetchAll(PDO::FETCH_ASSOC);

	//debug($infoscategories); 

	if($_POST){

		$urlPhotoPrincipale = '';
		$urlPhotosSecondaires = array();

		if($_FILES) {

			//debug($_FILES);

			foreach ($_FILES as $key => $value) {
				if(!empty($value['name'])) {

					$photoName = "photos/".date("U").$value['name'];
					

					if($key == "photoPrincipale") {


						
						$urlPhotoPrincipale = URL.$photoName;


					} else {
						array_push($urlPhotosSecondaires, URL."photos/".date("U").$value['name']);
					} 



					$photo_dossier = RACINE_SITE.$photoName;
					copy($value['tmp_name'], $photo_dossier);
				}
			}

		}

		/*for ($i=0; $i < 5; $i++) { 
			if(!isset($urlPhotosSecondaires[$i])) {
				$urlPhotosSecondaires[$i] = "";
			}
		}*/

		//debug($urlPhotosSecondaires);

		$idPhotosSecondaires = "";

		if(!empty($urlPhotosSecondaires)) {

			$requestInsertPhotos = "INSERT INTO photo (photo1, photo2, photo3, photo4, photo5) VALUES (:photo1, :photo2, :photo3, :photo4, :photo5)";
			$prepInsertPhotos = $pdo->prepare($requestInsertPhotos);

			$prepInsertPhotos->bindValue(":photo1", $urlPhotosSecondaires[0], PDO::PARAM_STR);
			$prepInsertPhotos->bindValue(":photo2", $urlPhotosSecondaires[1], PDO::PARAM_STR);
			$prepInsertPhotos->bindValue(":photo3", $urlPhotosSecondaires[2], PDO::PARAM_STR);
			$prepInsertPhotos->bindValue(":photo4", $urlPhotosSecondaires[3], PDO::PARAM_STR);
			$prepInsertPhotos->bindValue(":photo5", $urlPhotosSecondaires[4], PDO::PARAM_STR);

			$prepInsertPhotos->execute();

			$idPhotosSecondaires = $pdo->lastInsertId();
		}


		$request = "INSERT INTO annonce (titre, description_courte, description_longue, prix, photo, pays, ville, adresse, cp, id_categorie, id_membre, id_photo, date_enregistrement) VALUES (:titre, :description_courte, :description_longue, :prix, :urlPhotoPrincipale, :pays, :ville, :adresse, :cp, :id_categorie, :id_membre, :id_photo, NOW())";

		$prep = $pdo->prepare($request);

		$prep->bindValue(":titre", $_POST["titre"], PDO::PARAM_STR);
		$prep->bindValue(":description_courte", $_POST["description_courte"], PDO::PARAM_STR);
		$prep->bindValue(":description_longue", $_POST["description_longue"], PDO::PARAM_STR);
		$prep->bindValue(":prix", $_POST["prix"], PDO::PARAM_STR);
		$prep->bindValue(":urlPhotoPrincipale", $urlPhotoPrincipale, PDO::PARAM_STR);
		$prep->bindValue(":pays", $_POST["pays"], PDO::PARAM_STR);
		$prep->bindValue(":ville", $_POST["ville"], PDO::PARAM_STR);
		$prep->bindValue(":adresse", $_POST["adresse"], PDO::PARAM_STR);
		$prep->bindValue(":cp", $_POST["cp"], PDO::PARAM_STR);
		$prep->bindValue(":id_categorie", $_POST["categorie"], PDO::PARAM_STR);
		$prep->bindValue(":id_membre", $_SESSION["membre"]["id_membre"], PDO::PARAM_STR);
		$prep->bindValue(":id_photo", $idPhotosSecondaires, PDO::PARAM_STR);

		
		$prep->execute();

	}

?>

	<h1>Déposer votre annonce</h1>
	<form method="post" enctype="multipart/form-data">
		<input type="text" name="titre" placeholder="Titre">
		<input type="text" name="description_courte" placeholder="Description courte">
		<input type="text" name="description_longue" placeholder="Description longue">
		<input type="number" name="prix" placeholder="Prix">
		<select name="categorie">
		<?php
			for ($i=0; $i < count($infoscategories); $i++) { 
				echo "<option value='".strtolower($infoscategories[$i]['id_categorie'])."'>".ucfirst(strtolower($infoscategories[$i]['titre']))."</option>";
			}
		?>
		</select>
		<label for="photoPrincipale">Photo principale</label>
		<input type="file" name="photoPrincipale" id="photoPrincipale">
		<label for="photo1">Photo 1</label>
		<input type="file" name="photo1" id="photo1">
		<label for="photo2">Photo 2</label>
		<input type="file" name="photo2" id="photo2">
		<label for="photo3">Photo 3</label>
		<input type="file" name="photo3" id="photo3">
		<label for="photo4">Photo 4</label>
		<input type="file" name="photo4" id="photo4">
		<label for="photo5">Photo 5</label>
		<input type="file" name="photo5" id="photo5">

		<input type="text" name="pays" placeholder="Pays">
		<input type="text" name="ville" placeholder="Ville">
		<input type="text" name="adresse" placeholder="Adresse">
		<input type="number" name="cp" placeholder="Code postal">
		<input type="submit" value="Ajouter l'annonce">
	</form>

	<?php

	require_once("../inc/bas.inc.php");

	?>


