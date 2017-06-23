<!DOCTYPE html>
<html>
<head>
	<title>ANNONCEO</title>
	<link rel="stylesheet" type="text/css" href="/annonceo/inc/css/style.css">
</head>
<body>
	
	<header>
		<div class="conteneur">
			<a href="#" id="logo">Annon<span color:#ffab40>ceo</span></a>
			<nav>
				<?php
				echo "<ul>";
				

				/*if(internauteConnecteEstAdmin())
				{ */ // BackOffice
						echo '<li><a href="../admin/gestion_categorie.php">Gestion categories</a></li>';
						echo '<li><a href="../admin/gestion_annonces.php">Gestion annonces</a></li>';
						echo '<li><a href="../admin/gestion_membre.php">Gestion membres</a></li>';
						echo'<li><a href="#">Gestion notes</a></li>';
						echo '<li><a href="#">Gestion commentaires</a></li>';
						echo '<li><a href="#">Statistique</a></li>';
				//}
				if(internauteEstConnecte())
				{
						echo '<li><a href="#">Votre profil</a></li>';
						echo '<li><a href="formulaires/annonce.php">Ajouter une annonce</a></li>';
						echo '<li><a href="#">Déconnection</a></li>';

				}
				else // visiteur
				{

						echo '<li><a href="../formulaires/inscription.php">Inscription</a></li>';
						echo '<li><a href="../formulaires/connexion.php">Connexion</a></li>';
						echo '<li><a href="#">Espace membre</a></li>';
						echo '<li><a href="#">Accueil</a></li>';


				}
				echo "</ul>";
	
				
				?>

			</nav>
		</div> <!-- header/conteneur -->
	</header>
	
	<section>
		<div class="conteneur">
			

		
