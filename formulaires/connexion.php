<?php
require_once("../inc/init.inc.php");

require_once("../inc/haut.inc.php");

if($_POST) {

	$request = "SELECT * FROM membre WHERE pseudo = ".$_POST['pseudo'];
	$result = $pdo->query($request);

	if($result->rowCount() >= 1) {

		$membre = $result->fetch(PDO::FETCH_ASSOC);

		if(password_verify($_POST['mdp'], $membre['mdp']) || $_POST['mdp'] === $membre['mdp']) {
			//Connexion
			//$_SESSION['membre']
		}

		else echo "erreur de mot de passe";

	}

	else echo "erreur de pseudo";

}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="post">
		<input type="text" name="pseudo" placeholder="Pseudo">
		<input type="password" name="mdp" placeholder="Mot de passe">
		<input type="submit" value="Connexion">
	</form>

</body>
</html>

<?php
require_once("../inc/bas.inc.php");
?>