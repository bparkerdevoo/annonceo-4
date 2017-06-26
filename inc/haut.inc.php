<!DOCTYPE html>
<html>
<head>
	<title>ANNONCEO</title>
	<link rel="stylesheet" type="text/css" href="../inc/css/style.css">
	<script type="text/javascript" src="../inc/js/cdnJquery.js"></script>
	<script type="text/javascript" src="../inc/js/app.js"></script>
</head>
<body>
	
	<header>
			
			<nav>
				<?php
				echo "<ul>";
				
				echo '<li class="logo"><a href="'.URL.'accueil.php" id="logo">Annon<span color:#ffab40>ceo</span></a><li>';
				if(internauteConnecteEstAdmin())
				{ // BackOffice
						echo '<li><a href="'. URL .'admin/gestion_categorie.php">Gestion categories</a></li>';
						echo '<li><a href="../admin/gestion_annonces.php">Gestion annonces</a></li>';
						echo '<li><a href="'. URL .'admin/gestion_membre.php">Gestion membres</a></li>';
						echo'<li><a href="#">Gestion notes</a></li>';
						echo '<li><a href="'. URL .'admin/gestion_commentaire.php">Gestion commentaires</a></li>';
						echo '<li><a href="#">Statistique</a></li>';
				}
				if(internauteEstConnecte())
				{
						echo '<li><a href="#">Votre profil</a></li>';
						echo '<li><a href="'. URL .'formulaires/annonce.php">Déposer une annonce</a></li>';
						echo '<li><a href="#">Déconnexion</a></li>';

				}
				else // visiteur
				{

						echo '<li><a href="' . URL .'/formulaires/inscription.php">Inscription</a></li>';
						
						echo '<li><a href="#">Espace membre</a></li>';

						echo '<li id="logo_connexion"><a href="'. URL .'/formulaires/connexion.php"><img class="connexion" src="../inc/img/logoblacknwhite.png" ></a></li>';


				}
				echo "</ul>";
	
				
				?>

			</nav>
	</header>
	
	<section>
		<div class="conteneur">
			

		
