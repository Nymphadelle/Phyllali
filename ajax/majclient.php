<?php
	session_start();
	require_once '../Classes/Utilisateur.php';
	$user = new Utilisateur();
	$user->majUser($_SESSION['id'],$_POST['nom'],$_POST['prenom'],$_POST['addr'],$_POST['cp'],$_POST['ville']);
?>