<?php
	session_start();
	$_SESSION['id']='';
	$_SESSION['prenom']='';
	$_SESSION['mail']='';
	
	
	header('Location:../index.php');
?>