<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");


$req1=$pdo->query("SELECT * FROM commentaire");

$content.="<table><tr>";

for ($i=0; $i < $req1->ColumnCount(); $i++) { 
	$colonne= $req1->getColumnMeta($i)['name'];
	$content.="<th>". $colonne."</th>";
}

$content.="<th>actions</th>";

$content.="</tr>";

$content.="<tr>";
while ($commentaire=$req1->fetch(PDO::FETCH_ASSOC)){
	
	foreach ($commentaire as $key => $value) {
		$content.="<td>" . $value . "</td>";
	}

		$content.="<td><a href=\"?action=supprimer&id_categorie=".$categorie['id_categorie']."\"><img class='gestion' src='../inc/img/delete.png'></a>";

		$content.="<a href=\"?action=modifier&id_categorie=".$categorie['id_categorie']."\"><img class='gestion'  src='../inc/img/edit.png'></a>";
			
		$content.="<a href=\"?action=detail&id_categorie=".$categorie['id_categorie']."\"><img class='gestion' src='../inc/img/loupe.png'></a></td>";

		$content.="</tr>";

}


$content.="</tr></table>";



//-----supprimer


if(isset($_GET['action']) && $_GET['action'] == 'supprimer'){
	$pdo->query("DELETE FROM categorie WHERE id_commentaire = '$_GET[id_commentaire]'");
	header("location:../admin/gestion_commentaire.php");
}


//------------modifier

if(isset($_GET['action']) && $_GET['action'] == "modifier"){

	if($_POST){

		$pdo->query("UPDATE commentaire SET commentaire WHERE id_commentaire = '$_GET[id_commentaire]'");
		header("location:../admin/gestion_categorie.php");
	}

	$content.='<br><form method="post" action="">';

	$content.='<label for="commentaire">Changer le commentaire</label>';
	$content.='<input type="text" name="commentaire">';


	$content.='<input type="submit" value="enregister">';

	$content.='</form><br>';
	
}

echo $content;

?>


<?php
require_once("../inc/bas.inc.php");
?>