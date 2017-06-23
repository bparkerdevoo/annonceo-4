<?php
require_once("../inc/init.inc.php");
require_once("../inc/fonction.inc.php");
//--------envoi des donner dans bdd categorie

debug($_POST);

if($_POST && empty($_GET)){
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

		$content.="<td><a href=\"?action=supprimer&id_categorie=".$categorie['id_categorie']."\"><img src='../inc/img/delete.png' width='20' height='20'></a>";

		$content.="<a href=\"?action=modifier&id_categorie=".$categorie['id_categorie']."\"><img width='20' height='20' src='../inc/img/edit.png'></a>";
			
		$content.="<a href=\"?action=detail&id_categorie=".$categorie['id_categorie']."\"><img width='20' height='20' src='../inc/img/loupe.png'></a></td>";



		$content.="</tr>";
	}

	$content.="</table>";

//-----------requete de suppression
if(isset($_GET['action']) && $_GET['action'] == 'supprimer'){
	$pdo->query("DELETE FROM categorie WHERE id_categorie = '$_GET[id_categorie]'");
	header("location:../admin/gestion_categorie.php");



}


//----------requete de modification
if(isset($_GET['action']) && $_GET['action'] == "modifier"){

	if($_POST){

		$request3=$pdo->prepare("UPDATE categorie SET titre = :titre, motscles = :motscles WHERE id_categorie = '$_GET[id_categorie]'");

		$request3->bindValue(':titre',$_POST['titre'], PDO::PARAM_STR);

		$request3->bindValue(':motscles',$_POST['motscles'], PDO::PARAM_STR);

		$request3->execute();


		header("location:../admin/gestion_categorie.php");
	}
	
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