<?php
require_once("../inc/init.inc.php");
require_once("../inc/fonction.inc.php");
//--------envoi des donner dans bdd categorie
if($_POST){
	$request = $pdo->prepare("INSERT INTO categorie(titre,motscles)VALUES(:titre,:motscles)");

	$request->bindValue(':titre',$_POST['titre'], PDO::PARAM_STR);
	$request->bindValue(':motscles',$_POST['motscles'], PDO::PARAM_STR);

	$result = $request->execute();

	debug($_POST);

	$content.="<div class='validation'>Envoi validé</div>";

}
//-------affichage de la bdd categorie
$request2 =$pdo->query("SELECT * FROM categorie");
$content.="<table class='tableau';><tr>";

	for ($i=0; $i < $request2->columnCount(); $i++) { 

		$colonne= $request2->getColumnMeta($i)['name'];

		$content.="<th>". $colonne."</th>";
	}

	$content.="<th>actions</th>";
	$content.="</tr>";

	while($categorie=$request2->fetch(PDO::FETCH_ASSOC)){

		$content.="<tr>";

		foreach ($categorie as $key => $value) {
			$content.="<td>". $value . "</td>";
		}

		$content.="<td><a href=\"?action=supprimer&id_categorie=".$categorie['id_categorie']."\"><img src='../inc/img/delete.png' width='20' height='20'></a><a href=\"?action=modifier&id_categorie=".$categorie['id_categorie']."\"><img width='20' height='20' src='../inc/img/edit.png'></a><a href=\"?action=detail&id_categorie=".$categorie['id_categorie']."\"><img width='20' height='20' src='../inc/img/loupe.png'></a></td>";



		$content.="</tr>";
	}

	$content.="</table>";

//-----------requete de suppression
if(isset($_GET['action']) && $_GET['action'] == 'supprimer'){
	$pdo->query("DELETE FROM categorie WHERE id_categorie = '$_GET[id_categorie]'");

}

//----------requete de modification
if(isset($_POST['action']) && $_GET['action'] == "modifier"){
	$request3=$pdo->prepare("UPDATE categorie");
	
}


require_once("../inc/haut.inc.php");
echo $content;

?>



<form method="post">
	<label for="titre">Titre</label>
	<input type="text" name="titre" placeholder="titre" id="titre">
	
	<label for="motscles">Description courte</label>
	<textarea name="motscles" placeholder="description" id="motscles"></textarea>


	<input type="submit" value="envoyer">
	

</form>


<?php

require_once("../inc/bas.inc.php");
?>