<?php 
	session_start();
	require_once '../Classes/Produit.php';

	if( $_POST['cat'] != null && $_POST['libelle'] != null && $_POST['description'] != null )
	{
		$prod = new Produit;
		
		$uploaddir = '../Resources/PhotosTroc/';
		$uploadfile = $uploaddir . basename($_FILES['photo']['name']);

		move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
		
		$prod->insertProduct($_POST['cat'],$_SESSION['id'],$_POST['libelle'],$_POST['description'],$_POST['etat'],$_POST['delai'],$_FILES['photo']['name']);
		header('Location:../index.php');
	} else {
		echo "Tous les champs doivent être remplis!";
	}
?>