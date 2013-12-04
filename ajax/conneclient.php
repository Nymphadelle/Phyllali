<?php 
	session_start();
	require_once '../Classes/Utilisateur.php';
	$user = new Utilisateur();
	$utilisateur = $user->connectionUser($_POST['email'],$_POST['mdp']);
	if($utilisateur[0] != ''){
		$_SESSION['id']=$utilisateur[0];
		$_SESSION['prenom']=$utilisateur[1];
		$_SESSION['mail']=$utilisateur[2];
		echo $_SESSION['prenom'];
	}
	else{
		echo -1;
	}
	

?>