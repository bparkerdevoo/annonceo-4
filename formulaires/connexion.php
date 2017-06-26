<?php
require_once("../inc/init.inc.php");

if(isset($_GET['action']) && $_GET['action'] == 'deconnecter')
{
	unset($_SESSION['membre']);
	//session_unset();
	

}

require_once("../inc/haut.inc.php");

if(internauteEstConnecte())
{
	header("location:".URL."profil_membre.php");
	exit();
}


if($_POST) {

	$request = "SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'";

	$result = $pdo->query($request);

	if($result->rowCount() >= 1) {

		$membre = $result->fetch(PDO::FETCH_ASSOC);

		if(password_verify($_POST['mdp'], $membre['mdp']) || $_POST['mdp'] === $membre['mdp']) {
			//Connexion
			//$_SESSION['membre']

			$content .= "<div class='validation'>Connexion réussie";

			foreach ($membre as $key => $value) {
				$_SESSION['membre'][$key] = $value;

				
			}

			header("location:".URL."profil_membre.php");
		}

		else $content .= "<div class='erreur'> Erreur de mot de passe</div>";

	}

	else $content .= "<div class='erreur'>Erreur de pseudo</div>";

}


?>

<h1 class="titre">Connexion</h1>
<form method="post">
	<input type="text" name="pseudo" placeholder="Pseudo">
	<input type="password" name="mdp" placeholder="Mot de passe">
	<input type="submit" value="Connexion">
</form>

<?php

echo $content;

require_once("../inc/bas.inc.php");

?>

