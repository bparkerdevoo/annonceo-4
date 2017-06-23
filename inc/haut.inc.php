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
						
						echo '<li class="header-right"><a href="#">Inscription</a></li>';
						echo '<li class="header-right"><a href="#">Accès à la boutique</a></li>';
						echo '<li class="header-right"><a href="#"><img src='.URL.'inc/img/connexion25.jpg></a></li>';

				}
				echo "</ul>";
	
				
				?>

			</nav>
		</div> <!-- header/conteneur -->
	</header>
	
	<section>
		<div class="conteneur">
			

		
