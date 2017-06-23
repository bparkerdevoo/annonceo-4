<?php

require_once("inc/init.inc.php");

require_once("inc/haut.inc.php");

if(isset($_GET['id_annonce'])) {

	$request = "SELECT * FROM annonce WHERE id_annonce = ".$_GET['id_annonce'];
	$result = $pdo->query($request);

	$infos = $result->fetch(PDO::FETCH_ASSOC);

	//debug($infos);

	$content .= "<h1>".$infos['titre']."</h1>";
	$content .= "<div><img src='".$infos['photo']."'></div>";

	$content .= "<h2>Description : </h2><p>".$infos['description_longue']."</p>";
	$content .= "<h2>Prix : </h2><p>".$infos['prix']."</p>";
	$content .= "<h2>Adresse : </h2><p>".$infos['adresse'].", ".$infos['cp'].", ".$infos['ville']."</p>";

	$content .= "<a href='#'>Déposer un commentaire ou une note</a></br>";

	$content .= "<a href='#'>Retour vers les annonces</a>";

	echo $content;

}

require_once("inc/bas.inc.php");

?>