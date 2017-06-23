<?php
	require_once("../inc/init.inc.php");

	require_once("../inc/haut.inc.php");



	if($_POST) {


		$request = "INSERT INTO membre (pseudo, mdp, nom, prenom, telephone, email, civilite, statut, date_enregistrement) VALUES (:pseudo, :mdp, :nom, :prenom, :telephone, :email, :civilite, 0, CURDATE())";

		$prep = $pdo->prepare($request);

		foreach ($_POST as $key => $value) {
			$prep->bindValue(':'.$key, $value, PDO::PARAM_STR);
		}

		$prep->execute();

	}

?>


	<form method="post">
		<input type="text" name="pseudo" placeholder="Pseudo">
		<input type="password" name="mdp" placeholder="Mot de passe">
		<input type="text" name="nom" placeholder="Nom">
		<input type="text" name="prenom" placeholder="Prénom">
		<input type="text" name="telephone" placeholder="Téléphone">
		<input type="mail" name="email" placeholder="Mail">
		<select name="civilite">
			<option value="h">Homme</option>
			<option value="f">Femme</option>
		</select>
		<input type="submit" value="Inscription">
	</form>

<?php

require_once('../inc/bas.inc.php');
?>




