<?php

require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");

if($_POST)
{
	foreach ($_POST as $lignes => $valeurs)
	{
		echo "<pre>"; print_r($valeurs); echo "</pre>"."<br>";
		
	}
}


?>
		
 	<div class="conteneur-notation">
 		<form action="#" method="post" id="form-notes">Votre note<br/>
			  <input type="hidden" name="note" value="" id="note"/>
			  <label for="nom_prenom"></label>
			  <input type="nom_prenom" name="nom" id="nom_prenom" placeholder="votre nom prénom">
			 
			  <img class="st-color" src="../inc/img/star_clear.gif" id="clear_stars" title="Sans intérêt c'est trop nul">
			  <img class="st-color star" src="../inc/img/star_out.gif" id="star_1" class="star"/>
			  <img class="st-color star" src="../inc/img/star_out.gif" id="star_2" class="star"/>
			  <img class="st-color star" src="../inc/img/star_out.gif" id="star_3" class="star"/>
			  <img class="st-color star" src="../inc/img/star_out.gif" id="star_4" class="star"/>
			  <img class="st-color star" src="../inc/img/star_out.gif" id="star_5" class="star"/>
			  <!-- Ajouter autant d'étoile que nécessaire !-->
			  <input type="submit" value="Noter" class="bouton"/>
		</form>
	</div>	

<?php
require_once('../inc/bas.inc.php');
?>

