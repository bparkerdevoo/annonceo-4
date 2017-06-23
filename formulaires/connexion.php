<?php
require_once("../inc/init.inc.php");

require_once("../inc/haut.inc.php");

if($_POST) {

	$request = "SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'";

	$result = $pdo->query($request);

	if($result->rowCount() >= 1) {

		$membre = $result->fetch(PDO::FETCH_ASSOC);

		if(password_verify($_POST['mdp'], $membre['mdp']) || $_POST['mdp'] === $membre['mdp']) {
			//Connexion
			//$_SESSION['membre']

			foreach ($membre as $key => $value) {
				$_SESSION['membre'][$key] = $value;
			}

			$content .= "Connexion réussie";

		}

		else $content .= "Erreur de mot de passe";

	}

	else $content .= "Erreur de pseudo";

}


?>


<form method="post">
	<input type="text" name="pseudo" placeholder="Pseudo">
	<input type="password" name="mdp" placeholder="Mot de passe">
	<input type="submit" value="Connexion">
</form>

<?php

echo $content;

require_once("../inc/bas.inc.php");

?>

