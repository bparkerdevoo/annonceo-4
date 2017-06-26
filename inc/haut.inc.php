<!DOCTYPE html>
<html>
<head>
	<title>ANNONCEO</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href=" <?php echo URL ?>inc/css/style.css">
	
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
						echo '<li><a href="'. URL .'admin/gestion_annonces.php">Gestion annonces</a></li>';
						echo '<li><a href="'. URL .'admin/gestion_membre.php">Gestion membres</a></li>';
						echo'<li><a href="'. URL .'admin/gestion_notes.php">Gestion notes</a></li>';
						echo '<li><a href="'. URL .'admin/gestion_commentaire.php">Gestion commentaires</a></li>';
						echo '<li><a href="">Statistique</a></li>';
				}

				if(internauteEstConnecte())
				{
						echo '<li><a href="'.URL.'profil_membre.php">Votre profil</a></li>';
						echo '<li><a href="'. URL .'formulaires/annonce.php">Ajouter une annonce</a></li>';
						echo '<li><a href="'. URL .'formulaires/connexion.php?action=deconnecter">Déconnexion</a></li>';
						
				}
				else // visiteur
				{

						echo '<li><a href="' . URL .'formulaires/inscription.php">Inscription</a></li>';
						
						echo '<li><a href="'.URL.'profil_membre.php">Espace membre</a></li>';


						echo '<li id="logo_connexion"><a href="'. URL .'formulaires/connexion.php"><img class="connexion" src="'.URL.'inc/img/logoblacknwhite.png" ></a></li>';


				}
				echo "</ul>";
	
				
				?>

			</nav>
	</header>
	
	<section>
		<div class="conteneur">
			

	

