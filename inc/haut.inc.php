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
						echo '<a href="../admin/gestion_categorie.php">Gestion categories</a>';
						echo '<a href="../admin/gestion_annonces.php">Gestion annonces</a>';
						echo '<a href="../admin/gestion_membre.php">Gestion membres</a>';
						echo'<a href="#">Gestion des notes</a>';
						echo '<a href="#">Gestion des commentaires</a>';
						echo '<a href="#">Statistique</a>';
				//}
				if(internauteEstConnecte())
				{
						echo '<a href="#">Votre profil</a>';
						echo '<a href="formulaires/annonce.php">Ajouter une annonce</a>';
						echo '<a href="#">Déconnection</a>';

				}
				else // visiteur
				{

						echo '<a href="../formulaires/inscription.php">Inscription</a>';
						echo '<a href="../formulaires/connexion.php">Connexion</a>';
						echo '<a href="#">Espace membre</a>';
						echo '<a href="#">Accueil</a>';


				}
				echo "</ul>";
	
				
				?>

			</nav>
		</div> <!-- header/conteneur -->
	</header>
	
	<section>
		<div class="conteneur">
			

		
