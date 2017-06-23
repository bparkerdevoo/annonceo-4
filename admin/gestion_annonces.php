<?php

	require_once("../inc/init.inc.php");

	require_once("../inc/haut.inc.php");


	if(isset($_GET['action']) && $_GET['action'] == 'supprimer') {
		$requestDelete = "DELETE FROM annonce WHERE id_annonce = ".$_GET['id'];
		$pdo->query($requestDelete);
		header("location:gestion_annonces.php");
	}

	if(isset($_GET['action']) && $_GET['action'] == 'modifier') {

		$content .= "<form method='post' enctype='multipart/form-data'>";
		$content .=	"<input type='text' name='titre' placeholder='Titre'>";
		$content .=	"<input type='text' name='description_courte' placeholder='Description courte'>";
		$content .=	"<input type='text' name='description_longue' placeholder='Description longue'>";
		$content .= "<input type='number' name='prix' placeholder='Prix'>";
		$content .= "<input type='text' name='pays' placeholder='Pays'>";
		$content .= "<input type='text' name='ville' placeholder='Ville'>";
		$content .= "<input type='text' name='adresse' placeholder='Adresse'>";
		$content .= "<input type='number' name='cp' placeholder='Code postal'>";
		$content .= "<input type='submit' value=\"Ajouter l'annonce\">";

		if($_POST) {

			$request = "UPDATE annonce SET titre = :titre, description_courte = :description_courte, description_longue = :description_longue, prix = :prix, pays = :pays, ville = :ville, adresse = :adresse, cp = :cp WHERE id_annonce = ".$_GET['id'];

			$prep = $pdo->prepare($request);

			$prep->bindValue(":titre", $_POST["titre"], PDO::PARAM_STR);
			$prep->bindValue(":description_courte", $_POST["description_courte"], PDO::PARAM_STR);
			$prep->bindValue(":description_longue", $_POST["description_longue"], PDO::PARAM_STR);
			$prep->bindValue(":prix", $_POST["prix"], PDO::PARAM_STR);
			$prep->bindValue(":pays", $_POST["pays"], PDO::PARAM_STR);
			$prep->bindValue(":ville", $_POST["ville"], PDO::PARAM_STR);
			$prep->bindValue(":adresse", $_POST["adresse"], PDO::PARAM_STR);
			$prep->bindValue(":cp", $_POST["cp"], PDO::PARAM_STR);

			$prep->execute();

			header("location:gestion_annonces.php");
		}

		
	}

	if(empty($_GET)) {

		$request = "SELECT * FROM annonce";

		$result = $pdo->query($request);

		$content.= "<table><tr>";

		for ($i=0; $i < $result->columnCount(); $i++) { 
			$content.= "<th>".$result->getColumnMeta($i)['name']."</th>";
		}

		$content.= "<th>Actions</th>";

		$content.= "</tr>";

		while($infos = $result->fetch(PDO::FETCH_ASSOC)) {


			$content.= "<tr>";

			foreach ($infos as $value) {
				$content.= "<td>".$value."</td>";
			}

			$content.= "<td>";

			$content.= "<a href='?action=modifier&id=".$infos['id_annonce']."'><img class='gestion' src='../inc/img/edit.png'></a>";

			$content.= "<a href='?action=supprimer&id=".$infos['id_annonce']."'><img class='gestion' src='../inc/img/delete.png'></a>";

			$content.= "</td></tr>";
		}

		$content.= "</table>";

	}

	echo $content;



?>