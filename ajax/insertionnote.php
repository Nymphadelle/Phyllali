<?php
	session_start();
	require_once '../Classes/Troc.php';
	$troc = new Troc();
	$troc->ajouterNote($_SESSION['id'],$_POST['uti'],$_POST['com'],$_POST['note'],$_POST['troc']);

?>