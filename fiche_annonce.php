<?php

require_once("inc/init.inc.php");

require_once("inc/haut.inc.php");

if(isset($_GET['id_annonce'])) {

	$request = "SELECT * FROM annonce WHERE id_annonce = ".$_GET['id_annonce'];
	$result = $pdo->query($request);

	$infos = $result->fetch(PDO::FETCH_ASSOC);

	$requestPhotos = "SELECT * FROM photo WHERE id_photo IN (SELECT id_photo FROM annonce WHERE id_annonce = ".$_GET['id_annonce'].")";

	$resultPhotos = $pdo->query($requestPhotos);

	$photosSecondaires = $resultPhotos->fetchAll(PDO::FETCH_ASSOC);

	//debug($photosSecondaires);

	

	//debug($infos);

	$content .= "<h1 class='center'>".$infos['titre']."</h1>";
	$content .= "<div class='photoPrincipale'><img src='".$infos['photo']."'></div>";

	$content .= "<h2 class='center'>Description : </h2><p class='margin-bottom'>".$infos['description_longue']."</p>";
	$content .= "<h2 class='center'>Prix : </h2><p class='margin-bottom'>".$infos['prix']."€</p>";
	$content .= "<h2 class='center'>Adresse : </h2><p class='margin-bottom'>".$infos['adresse'].", ".$infos['cp'].", ".$infos['ville']."</p>";

	if(!empty($photosSecondaires)) {

		$content.="<ul class='liste-images'>";

		if(!empty($photosSecondaires[0]['photo1'])) {
			$content .= "<li><img src='".$photosSecondaires[0]['photo1']."' class='photoSecondaire'></li>";
		}

		if(!empty($photosSecondaires[0]['photo2'])) {
			$content .= "<li><img src='".$photosSecondaires[0]['photo2']."' class='photoSecondaire'></li>";
		}

		if(!empty($photosSecondaires[0]['photo3'])) {
			$content .= "<li><img src='".$photosSecondaires[0]['photo3']."' class='photoSecondaire'></li>";
		}

		if(!empty($photosSecondaires[0]['photo4'])) {
			$content .= "<li><img src='".$photosSecondaires[0]['photo4']."' class='photoSecondaire'></li>";
		}

		if(!empty($photosSecondaires[0]['photo5'])) {
			$content .= "<li><img src='".$photosSecondaires[0]['photo5']."' class='photoSecondaire'></li>";
		}

		$content.="</ul>";
	}

	$content.= "<br>";

	$content .= "<a href='?id_annonce=".$_GET['id_annonce']."&action=note'>Noter le vendeur</a></br>";

	$content .= "<a href='?id_annonce=".$_GET['id_annonce']."&action=commentaire'>Poster un commentaire</a></br>";

	$content .= "<a href='accueil.php'>Retour vers les annonces</a>";

	

	if(isset($_GET['action']) && $_GET['action'] == 'commentaire') {
		$content.= "<form method='post'>";
		$content.= "<label for='commentaire'>Votre commentaire</label>";
		$content.= "<textarea name='commentaire' id='commentaire'></textarea>";
		$content.= "<input type='submit' value='Envoyer le commentaire'>";
		$content.= "</form>";

		if($_POST) {
			$requestCommentaire = "INSERT INTO commentaire (id_membre, id_annonce, commentaire, date_enregistrement) VALUES (:id_membre, :id_annonce, :commentaire, NOW())";

			$prep = $pdo->prepare($requestCommentaire);

			$prep->bindValue(":id_membre", $_SESSION['membre']['id_membre']);
			$prep->bindValue(":id_annonce", $_GET['id_annonce']);
			$prep->bindValue(":commentaire", $_POST['commentaire']);

			$prep->execute();

			$content.="<div class='validation'>Votre commentaire a bien été enregisté</div>";

		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'note') {
		$content.= 
		'<div class="conteneur-notation">
	 		<form action="" method="post" id="form-notes">Votre note<br/>
				<input type="hidden" name="note" value="" id="note"/>
				<label for="nom_prenom"></label>
				<input type="nom_prenom" name="nom" id="nom_prenom" placeholder="votre nom prénom">
				<label for="avis">Votre avis</label>
				<textarea name="avis" placeholder="avis" id="avis"></textarea>
				 
				<img class="st-color" src="inc/img/star_clear.gif" id="clear_stars" title="Sans intérêt c\'est trop nul">
				<img class="st-color star" src="inc/img/star_out.gif" id="star_1" class="star"/>
				<img class="st-color star" src="inc/img/star_out.gif" id="star_2" class="star"/>
				<img class="st-color star" src="inc/img/star_out.gif" id="star_3" class="star"/>
				<img class="st-color star" src="inc/img/star_out.gif" id="star_4" class="star"/>
				<img class="st-color star" src="inc/img/star_out.gif" id="star_5" class="star"/>
				  <!-- Ajouter autant d\'étoile que nécessaire !-->
				<input type="submit" value="Noter" class="bouton" id="noteButton"/>
			</form>
		</div>	';

		if($_POST) {
			//debug($_POST);

			$requestPosteurAnnonce = "SELECT id_membre FROM annonce WHERE id_annonce =".$_GET['id_annonce'];

			$resultIdPosteur = $pdo->query($requestPosteurAnnonce);

			$idPosteur = $resultIdPosteur->fetch(PDO::FETCH_ASSOC);

			// debug($idPosteur);

			$request = "INSERT INTO note (id_membre1, id_membre2, note, avis, date_enregistrement) VALUES (:id_membre1, :id_membre2, :note, :avis, NOW())";

			$prep = $pdo->prepare($request);

			$prep->bindValue(":id_membre1", $_SESSION['membre']['id_membre']);
			$prep->bindValue(":id_membre2", $idPosteur['id_membre']);
			$prep->bindValue(":note", $_POST['note']);
			$prep->bindValue(":avis", $_POST['avis']);

			$prep->execute();

			$content.="<div class='validation'>Votre note a bien été enregistrée</div>";
		}
	}

	echo $content;



}



require_once("inc/bas.inc.php");

?>