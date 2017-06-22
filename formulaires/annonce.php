<?php

	require_once("../inc/init.inc.php");

	require_once("../inc/haut.inc.php");

	if($_POST){

		if($_FILES) {

			foreach ($_FILES as $value) {
				if(!empty($value['name'])) {

					debug($value);

					debug(RACINE_SITE."photos/".$value['name']);

					$photo_dossier = RACINE_SITE."photos/".$value['name'];
					copy($value['tmp_name'], $photo_dossier);
				}
			}
		}

		//debug($_POST);

		//debug($_FILES);

		//debug(RACINE_SITE."photos/");

		$request = "INSERT INTO annonce (titre, description_courte, description_longue, prix, pays, ville, adresse, cp, date_enregistrement) VALUES (:titre, :description_courte, :description_longue, :prix, :pays, :ville, :adresse, :cp, CURDATE())";

		$prep = $pdo->prepare($request);

			/*foreach ($_POST as $key => $value) {
				$prep->bindValue(':'.$key, $value, PDO::PARAM_STR);
			}*/

		$prep->bindValue(":titre", $_POST["titre"]);
		$prep->bindValue(":description_courte", $_POST["description_courte"]);
		$prep->bindValue(":description_longue", $_POST["description_longue"]);
		$prep->bindValue(":prix", $_POST["prix"]);
		$prep->bindValue(":pays", $_POST["pays"]);
		$prep->bindValue(":ville", $_POST["ville"]);
		$prep->bindValue(":adresse", $_POST["adresse"]);
		$prep->bindValue(":cp", $_POST["cp"]);

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


