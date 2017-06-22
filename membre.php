<?php
require_once('/inc/init.inc.php');
//require_once('../inc/fonction.inc.php');

$req = $pdo->query("SELECT *FROM membre");

$content .="<table border='1' style='border-collapse:collapse'><tr>";

for ($i=0; $i < $req->columnCount(); $i++)
{ 
	$colonne = $req->getColumnMeta($i);
	$content .= "<th>$colonne[name]</th>";
}
	$content .= "<th>Actions<img src='../inc/img/loupe.png'><img src='../inc/img/edit.png'><img src='../inc/img/delete.png'></th>";	
	$content .="</tr>";
	

while ($ligne = $req->fetch(PDO::FETCH_ASSOC))
{
	$content .="<tr>";
		foreach ($ligne as $indices => $valeurs)
		{
			$content .="<td>$valeurs</td>";
		}
	$content .="</tr>";
}

	$content .= "</table>";


require_once('/inc/haut.inc.php');
echo $content;

require_once('/inc/bas.inc.php');
?>