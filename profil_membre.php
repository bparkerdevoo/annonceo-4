<?php
require_once("inc/init.inc.php");
require_once("inc/haut.inc.php");

if(!internauteEstConnecte()){
	$content.="<div class='erreur'>Merci de vous connecter.</div>";
	header("location:".URL."/formulaires/connexion.php");
	
}

$content .= '<h2>Bonjour <strong>' . $_SESSION['membre']['pseudo'] . '!</strong></h2>';


$content .= '<div><p> Informations de votre profil </p></div>';


$resultat=$pdo->query("SELECT pseudo,mdp,nom,prenom,telephone,email,civilite FROM membre WHERE id_membre=".$_SESSION['membre']['id_membre']);//mettre un id hidden pour modif
//debug($resultat);
//debug($resultat->fetchAll(PDO::FETCH_ASSOC));

$content .="<table><tr>";
$membre=$resultat->fetch(PDO::FETCH_ASSOC);
for ($i=0; $i<$resultat->columnCount(); $i++) { 
	$colonne=$resultat->getColumnMeta($i)['name'];
	$content.="<th>".$colonne."</th>";
}

$content.="<th>actions</th>";
$content.="</tr>";


$content.="<tr>";
$content.="<td>". $_SESSION['membre']['pseudo'] ."</td>";
$content.="<td>mot de passe</td>";
$content.="<td>". $_SESSION['membre']['nom'] ."</td>";
$content.="<td>". $_SESSION['membre']['prenom'] ."</td>";
$content.="<td>". $_SESSION['membre']['telephone'] ."</td>";
$content.="<td>". $_SESSION['membre']['email'] ."</td>";
$content.="<td>". $_SESSION['membre']['civilite'] ."</td>";



$content.="<td><a href='?action=modification&id_membre=".$_SESSION['membre']['id_membre']."'><img class='gestion' src='inc/img/edit.png'></a></td>";


/*while ($membre=$resultat->fetch(PDO::FETCH_ASSOC)){

	$content.="<tr>";

	foreach ($membre as $key => $value) {
		$content.="<td>".$value."</td>";
	}

	$content.="</tr>";
}*/

$content .='</tr></table>';

if(isset($_GET['action']) && $_GET['action'] == 'modification'){

	$content.="<form method='post'>";
	$content.="<input type='text' name='pseudo' placeholder='pseudo'>";
	$content.="<input type='text'  name='mdp' placeholder='mot de passe'>";
	$content.="<input type='text'  name='nom' placeholder='nom'>";
	$content.="<input type='text'  name='prenom' placeholder='prenom'>";
	$content.="<input type='text'  name='telephone' placeholder='téléphone'>";
	$content.="<input type='text'  name='email' placeholder='email'>";
	$content.="<select name='civilite'><option value='m' selected>M</option><option value='f'>F</option>";
	$content.="<input type='submit' value='envoyer'></form>";

	//debug($_SESSION);


	if($_POST){

		$request2=$pdo->prepare("UPDATE membre SET pseudo = :pseudo, mdp = :mdp, nom=:nom, prenom = :prenom, telephone = :telephone, email = :email, civilite=:civilite WHERE id_membre =".$_GET['id_membre']);

		$request2->bindValue(':pseudo',$_POST['pseudo']);

		$request2->bindValue(':mdp',$_POST['mdp']);

		$request2->bindValue(':nom',$_POST['nom']);

		$request2->bindValue(':prenom',$_POST['prenom']);

		$request2->bindValue(':telephone',$_POST['telephone']);

		$request2->bindValue(':email',$_POST['email']);

		$request2->bindValue(':civilite',$_POST['civilite']);


		$request2->execute();

		debug($_POST);

		/*$request2=$pdo->query("UPDATE membre SET pseudo = $_POST[pseudo], mdp = $_POST[mdp], nom=$_POST[nom], prenom = $_POST[prenom], telephone = $_POST[telephone], email = $_POST[email], civilite=$_POST[civilite] WHERE id_membre =".$_GET['id_membre']);*/

		//header("location:profil_membre.php");

	}
}

$content .= '<div><p> Vos annonces</p></div>';




echo $content;

//debug($_SESSION);

require_once("inc/bas.inc.php");
?>