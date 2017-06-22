<?php

	require_once("../inc/init.inc.php");

	require_once("../inc/haut.inc.php");

	$request = "SELECT * FROM annonce";

	$result = $pdo->query($request);

	$content.= "<table><tr>";

	for ($i=0; $i < $result->columnCount(); $i++) { 
		$content.= "<th>".$result->getColumnMeta($i)['name']."</th>";
	}

	$content.= "</tr>";

	while($infos = $result->fetch(PDO::FETCH_ASSOC)) {

		$content.= "<tr>";

		foreach ($infos as $value) {
			$content.= "<td>".$value."</td>";
		}

		$content.= "</tr>";
	}

	$content.= "</table>";

	echo $content;

	require_once("../inc/bas.inc.php");

?>