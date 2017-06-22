<?php
//Le fichier init.inc.php permet de :
// -démarer une session
// -initialisation du site
// -se connecter à la base de données
// -il faut l'inclure dans toutes les pages

//-------------------BDD------------------
$pdo = new PDO('mysql:host=localhost;dbname=annonceo','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//--------------------- DEMARRAGE DE SESSION--------
session_start();
// chemin dossier
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'].'/annonceo/');
// chemin physique du site (avec tous les dossiers)
define("URL", 'http://localhost/annonceo/');

// declaration variable à utiliser

$content = '';






// inclusions des fonctions
require_once('fonction.inc.php');


?>