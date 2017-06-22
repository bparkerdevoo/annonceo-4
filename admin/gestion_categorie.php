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
$content.="<table class='tableau' border='1' style='border-collapse=collapse';><tr>";

	for ($i=0; $i < $request2->columnCount(); $i++) { 
		$colonne= $request2->getColumnMeta($i)['name'];

		$content.="<td>". $colonne."</td>";
	}
	$content.="<th>Supprimer</th>";

	while($categorie=$request2->fetch(PDO::FETCH_ASSOC)){

		$content.="<tr>";

		foreach ($categorie as $key => $value) {
			$content.="<td>". $value . "</td>";
		}

		$content.="<td><a href=\"?action=supprimer&id_categorie=".$categorie['id_categorie']."\">supprimer</a></td>";
		$content.="</tr>";
	}

	$content.="</table>";

//------suppression
if(isset($_GET['action']) && $_GET['action'] == 'supprimer'){
	$pdo->query("DELETE FROM categorie WHERE id_categorie = '$_GET[id_categorie]'");

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