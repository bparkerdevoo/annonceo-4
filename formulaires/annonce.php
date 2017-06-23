<?php

	require_once("../inc/init.inc.php");

	require_once("../inc/haut.inc.php");

	if($_POST){

		if($_FILES) {

			foreach ($_FILES as $value) {
				if(!empty($value['name'])) {


					$urlPhoto = URL."photos/".$value['name'].$value['id_annonce'];

					//debug($urlPhoto);

					$photo_dossier = RACINE_SITE."photos/".$value['name'].$value['id_annonce'];
					copy($value['tmp_name'], $photo_dossier);
				}
			}
		}

		//debug($_POST);

		//debug($_FILES);

		//debug(RACINE_SITE."photos/");

		$request = "INSERT INTO annonce (titre, description_courte, description_longue, prix, photo, pays, ville, adresse, cp, date_enregistrement) VALUES (:titre, :description_courte, :description_longue, :prix, :urlPhoto, :pays, :ville, :adresse, :cp, CURDATE())";

		debug($request);

		$prep = $pdo->prepare($request);

			/*foreach ($_POST as $key => $value) {
				$prep->bindValue(':'.$key, $value, PDO::PARAM_STR);
			}*/

		$prep->bindValue(":titre", $_POST["titre"], PDO::PARAM_STR);
		$prep->bindValue(":description_courte", $_POST["description_courte"], PDO::PARAM_STR);
		$prep->bindValue(":description_longue", $_POST["description_longue"], PDO::PARAM_STR);
		$prep->bindValue(":prix", $_POST["prix"], PDO::PARAM_STR);
		$prep->bindValue(":urlPhoto", $urlPhoto, PDO::PARAM_STR);
		$prep->bindValue(":pays", $_POST["pays"], PDO::PARAM_STR);
		$prep->bindValue(":ville", $_POST["ville"], PDO::PARAM_STR);
		$prep->bindValue(":adresse", $_POST["adresse"], PDO::PARAM_STR);
		$prep->bindValue(":cp", $_POST["cp"], PDO::PARAM_STR);

		$prep->execute();

	}

?>


	<form method="post" enctype="multipart/form-data">
		<input type="text" name="titre" placeholder="Titre">
		<input type="text" name="description_courte" placeholder="Description courte">
		<input type="text" name="description_longue" placeholder="Description longue">
		<input type="number" name="prix" placeholder="Prix">
		<select name="categorie"></select>
		<input type="file" name="photo1" placeholder="Photo 1">
		<input type="file" name="photo2" placeholder="Photo 2">
		<input type="file" name="photo3" placeholder="Photo 3">
		<input type="file" name="photo4" placeholder="Photo 4">
		<input type="file" name="photo5" placeholder="Photo 5">
		<input type="text" name="pays" placeholder="Pays">
		<input type="text" name="ville" placeholder="Ville">
		<input type="text" name="adresse" placeholder="Adresse">
		<input type="number" name="cp" placeholder="Code postal">
		<input type="submit" value="Ajouter l'annonce">
	</form>

	<?php

	require_once("../inc/bas.inc.php");

	?>


