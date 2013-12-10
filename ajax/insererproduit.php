<?php 
	session_start();
	
	require_once '../Classes/Produit.php';
	$prod = new Produit;
	echo $prod->insertProduct($_POST['cat'],$_SESSION['id'],$_POST['libelle'],$_POST['description'],$_POST['etat'],$_POST['delai'],$_POST['photo']);
?>