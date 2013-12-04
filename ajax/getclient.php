<?php 
	session_start();
	require_once '../Classes/Utilisateur.php';
	$user = new Utilisateur();
	$usr = $user->getUser($_SESSION['id']);
	echo $_SESSION['id'];
?>