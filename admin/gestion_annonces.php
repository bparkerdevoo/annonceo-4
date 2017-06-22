<?php

	require_once("../inc/init.inc.php");

	require_once("../inc/haut.inc.php");


	if(isset($_GET['action']) && $_GET['action'] == 'supprimer') {
		$requestDelete = "DELETE FROM annonce WHERE id_annonce = ".$_GET['id'];
		$pdo->query($requestDelete);
		header("location:gestion_annonces.php");
	}




	$request = "SELECT * FROM annonce";

	$result = $pdo->query($request);

	$content.= "<table><tr>";

	for ($i=0; $i < $result->columnCount(); $i++) { 
		$content.= "<th>".$result->getColumnMeta($i)['name']."</th>";
	}

	$content.= "<th>Actions</th>";

	$content.= "</tr>";

	while($infos = $result->fetch(PDO::FETCH_ASSOC)) {

		$content.= "<tr>";

		foreach ($infos as $value) {
			$content.= "<td>".$value."</td>";
		}

		$content.= "<td>";

		$content.= "<a href='?action=modifier&id=".$infos['id_annonce']."'>Modifier</a>";

		$content.= "<a href='?action=supprimer&id=".$infos['id_annonce']."'>Supprimer</a>";

		$content.= "</td></tr>";
	}

	$content.= "</table>";

	echo $content;



?>