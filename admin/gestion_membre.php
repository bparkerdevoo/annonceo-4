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
			$content .="<td><a href='#'><img class='gestion' src='../inc/img/loupe.jpg'></a>";

			$content .="<a href=\"?action=modification&id_membre=".$ligne['id_membre']."\"><img class='gestion' src='../inc/img/edit.png'></a>";

			$content .="<a href=\"?action=suppression&id_membre=".$ligne['id_membre']."\" OnClick='return(confirm(\"En êtes-vous sûr ?\"));'><img class='gestion' src='../inc/img/delete.png'></a></td>";

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
	if ($_POST)
		{
			$prep=$pdo->prepare("UPDATE membre SET pseudo= :pseudo, mdp= :mdp, nom = :nom, prenom= :prenom, email= :email, telephone= :telephone, statut= :statut WHERE id_membre='$_GET[id_membre]'");

			$prep->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
			$prep->bindValue(':mdp',$_POST['mdp'], PDO::PARAM_STR);
			$prep->bindValue(':nom',$_POST['nom'], PDO::PARAM_STR);
			$prep->bindValue(':prenom',$_POST['prenom'], PDO::PARAM_STR);
			$prep->bindValue(':email',$_POST['email'], PDO::PARAM_STR);
			$prep->bindValue(':telephone',$_POST['telephone'], PDO::PARAM_STR);
			$prep->bindValue(':statut',$_POST['statut'], PDO::PARAM_STR);

			$prep->execute();

			header("location:gestion_membre.php");
		}

//--RECUPERATION DES INFO A MODIFIER AU CLICK ICON EDIT--
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

			
echo '
<form method="post" action="#" enctype="multipart/form-data">
	<label for="pseudo">Pseudo</label>
	<input type="pseudo" name="pseudo" id="pseudo" value="'.$pseudo.'"placeholder="pseudo">
	
	<label for="mdp">Mot de passe</label>
	<input type="mdp" name="mdp" id="mdp" value="'.$mdp.'"placeholder="mot de passe">

	<label for="nom">Nom</label>
	<input type="nom" name="nom" id="nom" value="'.$nom.'"placeholder="votre nom">
	
	<label for="prenom">Prénom</label>
	<input type="prenom" name="prenom" id="prenom" value="'.$prenom.'"placeholder="votre prénom">

	<label for="email">Email</label>
	<input type="email" name="email" id="email" value="'.$email.'"placeholder="votre email">
	
	<label for="telephone">telephone</label>
	<input type="telephone" name="telephone" id="telephone" value="'.$telephone.'"placeholder="telephone">

	<label for="civilite">Civilité</label>
	<select name="civilite" id="civilite">
			<option name="civilite" value="m"'; if($civilite == "m") echo'selected'; echo'>Homme</option>
			<option name="civilite" value="f"'; if($civilite == "f") echo'selected'; echo'>Femme</option>
	</select>

	<label for="statut">Statut</label>
	<select name="statut" id="statut">
			<option value="1">Admin</option>
			<option value="0">Membre</option>
	</select>

	<input type="submit" value="enregistrer">

	


</form>';
}

?>



<?php 

require_once('../inc/bas.inc.php');

?>