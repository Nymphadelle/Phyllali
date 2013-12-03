<?php 
	require_once '../Classes/Utilisateur.php';
	$user = new Utilisateur();
	echo $user->insertUser($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['psw'],$_POST['addr'],$_POST['cp'],$_POST['ville']);

?>