<?php

require_once("/inc/init.inc.php");

require_once("/inc/haut.inc.php");

$requestCategories = "SELECT * FROM categorie";
$resultCategories = $pdo->query($requestCategories);

$infoscategories = $resultCategories->fetchAll(PDO::FETCH_ASSOC);

$content.= "<form method='post'>";
$content.= "<select>";

for ($i=0; $i < count($infoscategories); $i++) { 
	$content.= "<option value='".strtolower($infoscategories[$i]['id_categorie'])."'>".ucfirst(strtolower($infoscategories[$i]['titre']))."</option>";
}

$content.= "</select>";
$content.= "</form>";

$nombreAnnoncesAffichees = 20;

$request = "SELECT * FROM annonce LIMIT 0, ".$nombreAnnoncesAffichees;
$result = $pdo->query($request);

while($infos = $result->fetch(PDO::FETCH_ASSOC)) {
	//debug($infos);
	$content .= "<section><a href='fiche_annonce.php?id_annonce=".$infos['id_annonce']."'>".$infos['titre']."</a>";
	$content .= "<div><img src='".$infos['photo']."'></div>";

	$content .= "<p>".$infos['description_courte']."</p>";
	$content .= "<p>".$infos['prix']."€</p>";

	$content .= "</section>";
}

echo $content;

require_once("inc/bas.inc.php");

?>