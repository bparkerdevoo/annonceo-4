<?php
//On créé 1 fonction de débugage qui retourne une var_dump grace à la variable $var placer en argument



function debug($var,$mode = 1)

{
//la fonction debug_backtrace() renvoie le fichier dans lequel nous l'executons ainsi que le numero de la ligne	
	$trace = debug_backtrace();

// SI BESOIN : fonction qui supprime le 1er element du tableau pour le stocker dans une variable
	/*$trace = array_shift($trace);

	echo "<strong>debug demandé dans le ficher ".$trace['file']." en ligne ".$trace['line']." </strong>";*/

	if ($mode ==1) {
		
		echo "<pre>";print_r($var); echo "</pre>";
	}

	else {

		echo "<pre>";var_dump($var); echo "</pre>";
	}

}
//---------------fonctions connection internaute----
function internauteEstConnecte() {

	if (!isset($_SESSION['membre']))
	 {
		return false; // si internaute connecté !membre
	}
	 else
	 {
	 	return true;


	}
	
}
//--------si internaute connecté = Admin----
function internauteConnecteEstAdmin()
{
	if (internauteEstConnecte() && $_SESSION['membre']['statut'] ==1)
	 {
	 	return true;
	 }
	else
	{
	 	return false;
	 }


}


?>