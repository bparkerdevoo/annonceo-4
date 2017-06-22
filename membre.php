<?php
require_once('/inc/init.inc.php');


require_once('/inc/haut.inc.php');

$req = $pdo->query("SELECT *FROM membre");

$content .="<table><tr>";

for ($i=0; $i < $req->columnCount(); $i++)
{ 
	$colonne = $req->getColumnMeta($i);
	$content .= "<th>$colonne[name]</th>";
}
	$content .= "<th>Actions</th>";	
	$content .="</tr>";
	

while ($ligne = $req->fetch(PDO::FETCH_ASSOC))
{
	$content .="<tr>";
		foreach ($ligne as $indices => $valeurs)
		{
			$content .="<td>".$valeurs."</td>";
		}
			$content .="<td><a href='#'><img src='/inc/img/loupe.png'></a><a href='#'<img src='/inc/img/edit.png'></a><a href='#'><img src='/inc/img/delete.png'></a></td>";

	$content .="</tr>";
}

	$content .= "</table>";



echo $content;

require_once('/inc/bas.inc.php');
?>