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

//--RECUPERATION DES INFO A MODIFIER AU CLICK ICON EDIT--

if(isset($_GET['action']) && $_GET['action'] == 'modification')
{
	if (isset($_GET['id_membre']))
		{
			$resultat = $pdo->query("SELECT *FROM membre WHERE id_membre=$_GET[id_membre]");
			$membre_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
		}

			$id_membre = (isset($membre_actuel['id_membre']))?
			$membre_actuel['id_membre'] :'';

			$pseudo = (isset($membre_actuel['pseudo']))?
			$membre_actuel['pseudo'] :'';

			$mdp = (isset($membre_actuel['mdp']))?
			$membre_actuel['mdp'] :'';

			$nom = (isset($membre_actuel['nom']))?
			$membre_actuel['nom'] :'';

			$prenom = (isset($membre_actuel['prenom']))?
			$membre_actuel['prenom'] :'';

			$email = (isset($membre_actuel['email']))?
			$membre_actuel['email'] :'';

			$telephone = (isset($membre_actuel['telephone']))?
			$membre_actuel['telephone'] :'';

			$civilite = (isset($membre_actuel['civilite']))?
			$membre_actuel['civilite'] :'';

//--------------------recuperation donnees dans les champs formulaires----------------
	$content.="<form method='post'>";
	$content.="<input type='text' name='pseudo' value='".$titre."' placeholder='pseudo'>";
	$content.="<input type='text'  name='mdp' value='".$mdp."' placeholder='mot de passe'>";
	$content.="<input type='text'  name='nom' value='".$nom."' placeholder='nom'>";
	$content.="<input type='text'  name='prenom' value='".$prenom."' placeholder='prenom'>";
	$content.="<input type='text'  name='telephone' value='".$telephone."' placeholder='téléphone'>";
	$content.="<input type='text'  name='email' value='".$email."' placeholder='email'>";
	$content.="<select name='civilite'>";

	$content.= "<option name='civilite' value='m'";
	if($civilite == "m") 
	{
		$content.='selected';
	}
	$content.=">M</option>";

	$content.= "<option name='civilite' value='f'";
	if($civilite == "f") 
	{
		$content.='selected';
	}
	$content.=">F</option>";

	$content.="</select>";
	$content.="<input type='submit' value='envoyer'></form>";

	//debug($_SESSION);



	if($_POST){

		$request2=$pdo->prepare("UPDATE membre SET pseudo = :pseudo, mdp = :mdp, nom=:nom, prenom = :prenom, telephone = :telephone, email = :email, civilite=:civilite WHERE id_membre =".$_GET["id_membre"]);

		$request2->bindValue(":pseudo",$_POST["pseudo"]);

		$request2->bindValue(":mdp",$_POST["mdp"]);

		$request2->bindValue(":nom",$_POST["nom"]);

		$request2->bindValue(":prenom",$_POST["prenom"]);

		$request2->bindValue(":telephone",$_POST["telephone"]);

		$request2->bindValue(":email",$_POST["email"]);

		$request2->bindValue(":civilite",$_POST["civilite"]);


		$request2->execute();
		$content.="<div class='validation'>Vos modifications ont été pris en compte. Veuillez vous reconnecter pour voir les changements effectifs</div>";
		debug($_POST);

		/*$request2=$pdo->query("UPDATE membre SET pseudo = $_POST[pseudo], mdp = $_POST[mdp], nom=$_POST[nom], prenom = $_POST[prenom], telephone = $_POST[telephone], email = $_POST[email], civilite=$_POST[civilite] WHERE id_membre =".$_GET["id_membre"]);*/

		//header("location:profil_membre.php");

	}
}

$content .= "<div><p> Vos annonces</p></div>";


//--------------------------------note et avis--------------------------------------------
$request4=$pdo->query("SELECT note, avis FROM note WHERE id_membre2 =". $_SESSION['membre']['id_membre']);
/*$request3=$pdo -> query("
	SELECT c.commentaire, n.note, n.avis 
	FROM commentaire c
	LEFT JOIN annonce a ON a.id_annonce = c.id_annonce
	LEFT JOIN note n ON n.id_membre2 = a.id_membre
	AND n.id_membre2 = " . $_SESSION['membre']['id_membre']);

$infos_note = $request3 -> fetchAll(PDO::FETCH_ASSOC);

debug($infos_note);*/

//debug($request3->fetch(PDO::FETCH_ASSOC));

/*$request4=$pdo->query("
	SELECT n.note, n.avis ,a.titre 
	FROM note n, annonce a
	WHERE n.id_membre2 = a.id_membre
	AND n.id_membre2 =". $_SESSION['membre']['id_membre']
	);*/


$content.="<table id='tabAvis'><tr>";
for ($i=0; $i < $request4->columnCount(); $i++) { 
	$colonne= $request4->getColumnMeta($i)['name'];


$request3=$pdo -> query("SELECT c.commentaire, n.note, n.avis 
	FROM commentaire c, note n 
	WHERE c.id_membre = n.id_membre2 
	AND n.id_membre2 = " . $_SESSION["membre"]["id_membre"]);
//debug($request3);

$content.="<table><tr>";
for ($i=0; $i < $request3->ColumnCount(); $i++) { 
	$colonne= $request3->getColumnMeta($i)["name"];

	$content.="<th>". $colonne."</th>";
}

$content.="</tr>";


while ($profil=$request4->fetch(PDO::FETCH_ASSOC)){
	$content.="<tr>";
	foreach ($profil as $key => $value) {
		$content.="<td>" . $value . "</td>";
	}
	$content.="</tr>";
}

$content.="</table>";


//------------------commentaire-------------------------------

$request5=$pdo->query("
	SELECT a.titre,c.commentaire
	FROM commentaire c, annonce a
	WHERE c.id_annonce = a.id_annonce
	AND a.id_membre =". $_SESSION['membre']['id_membre']);

$content.="<table id='tabComm'><tr>";
for ($i=0; $i < $request5->columnCount(); $i++) { 
	$colonne= $request5->getColumnMeta($i)['name'];
	$content.="<th>". $colonne."</th>";
}

$content.="</tr>";


while ($profil=$request5->fetch(PDO::FETCH_ASSOC)){
	$content.="<tr>";
	foreach ($profil as $key => $value) {
		$content.="<td>" . $value . "</td>";
	}
	$content.="</tr>";
}

$content.="</table>";


echo $content;

//debug($_SESSION);

require_once("inc/bas.inc.php");
?>