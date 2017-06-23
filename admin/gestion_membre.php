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


/***********REQUETE INJECTION DONNEES DANS SQL*****/
//$data = $pdo->query


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

require_once('/inc/bas.inc.php');

?>