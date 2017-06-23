<?php
require_once('../inc/init.inc.php');


require_once('../inc/haut.inc.php');

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
			$content .="<td><a href='#'><img src='../inc/img/loupe.jpg'></a><a href='#'><img class='gestion' src='../inc/img/edit.png'></a><a href='#'><img class='gestion' src='../inc/img/delete.png'></a></td>";

	$content .="</tr>";
}

$content .= "</table>";
echo $content;


/***********REQUETE MODIFICATION BDD MEMBRE*****/
if (isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	$reqdelete = $pdo->query("DELETE FROM membre WHERE id_membre = $_GET[id_membre]");
	header("location:gestion_membre.php");
}

if (isset($_GET['action']) && $_GET['action'] == "modification")
{
		$content .= "<form method='post' enctype='multipart/form-date'>";
		$content .= "<input name='pseudo'>";
		$content .= "<input name='mdp'>";
		$content .= "<input name='nom'>";
		$content .= "<input name='prenom'>";
		$content .= "<input name='email'>";
		$content .= "<input name='telephone'>";
		$content .= "<input name='statut'>";
		$content .= "<button value='enregistrer'>";

		if ($_POST)
		{
			$reqedit = ("UPDATE membre SET pseudo= :pseudo, mdp= :mdp, nom = :nom, prenom= :prenom, email= :email, telephone= :telephone, statut= :statut");

			$prep= $pdo->prepare($reqedit);

			$prep->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
			$prep->bindValue(':mdp',$_POST['mdp'], PDO::PARAM_STR);
			$prep->bindValue(':nom',$_POST['nom'], PDO::PARAM_STR);
			$prep->bindValue(':prenom',$_POST['prenom'], PDO::PARAM_STR);
			$prep->bindValue(':email',$_POST['email'], PDO::PARAM_STR);
			$prep->bindValue(':telephone',$_POST['telephone'], PDO::PARAM_STR);
			$prep->bindValue(':statut',$_POST['statut'], PDO::PARAM_STR);

			$prep= $pdo->execute($reqedit);

			header("location:gestion_membre.php");
		}
}



?>

<form method="post" action="">
	<label for="pseudo">Pseudo</label>
	<input type="pseudo" name="pseudo" id="pseudo" placeholder="pseudo">
	
	<label for="mdp">Mot de passe</label>
	<input type="mdp" name="mdp" id="mdp" placeholder="mot de passe">

	<label for="nom">Nom</label>
	<input type="nom" name="nom" id="nom" placeholder="votre nom">
	
	<label for="prenom">Prénom</label>
	<input type="prenom" name="prenom" id="prenom" placeholder="votre prénom">

	<label for="email">Email</label>
	<input type="email" name="email" id="email" placeholder="votre email">
	
	<label for="telephone">telephone</label>
	<input type="telephone" name="telephone" id="telephone" placeholder="telephone">

	<label for="civilite">Civilité</label>
	<select name="civilite" id="civilite">
			<option value="homme">Homme</option>
			<option value="femme">Femme</option>
	</select>

	<label for="statut">Statut</label>
	<select name="statut" id="statut">
			<option value="1">Admin</option>
			<option value="0">Membre</option>
	</select>

	<button value="enregistrer" class="primary"></button>


</form>

<?php 

require_once('../inc/bas.inc.php');

?>