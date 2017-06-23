<?php

require_once("inc/init.inc.php");

require_once("inc/haut.inc.php");

$nombreAnnoncesAffichees = 3;

$request = "SELECT * FROM annonce LIMIT 0, ".$nombreAnnoncesAffichees;
$result = $pdo->query($request);

while($infos = $result->fetch(PDO::FETCH_ASSOC)) {
	//debug($infos);
	$content .= "<section><a href='fiche_annonce.php?id_annonce=".$infos['id_annonce']."'>".$infos['titre']."</a>";

	$content .= "<p>".$infos['description_courte']."</p>";
	$content .= "<p>".$infos['prix']."€</p>";

	$content .= "</section>";
}

echo $content;

require_once("inc/bas.inc.php");

?>