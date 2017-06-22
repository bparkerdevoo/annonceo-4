<!DOCTYPE html>
<html>
<head>
	<title>ANNONCEO</title>
	<link rel="stylesheet" type="text/css" href="/annonceo/inc/css/style.css">
</head>
<body>
	
	<header>
		<div class="conteneur">
			<span>
				<a href="#">Annonceo</a>
			</span>	
			
			<nav>
				<?php
				

				if(internauteConnecteEstAdmin())
				{  // BackOffice
						echo '<a href="#">Déposer annonce</a>';
						echo '<a href="#">Boutique</a>';
						echo '<a href="#">Espace membre</a>';
				}
				if(internauteEstConnecte())
				{
						echo '<a href="#">Voir votre profil</a>';
						echo '<a href="#">Accès à la boutique</a>';
						echo '<a href="#">Se déconnecter</a>';

				}
				else // visiteur
				{
						echo '<a href="#">Inscription</a>';
						echo '<a href="#">Accès à la boutique</a>';
						echo '<a href="#">Connexion</a>';

				}

	
				
				?>

			</nav>
		</div> <!-- header/conteneur -->
	</header>
	
	<section>
		<div class="conteneur">
			

		
