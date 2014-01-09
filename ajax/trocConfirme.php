<?php

require_once("../Classes/Troc.php");
require_once("../Classes/Utilisateur.php");

$user = new Utilisateur();
session_start();

if (isset($_POST['idtroc']) && isset($_POST['pdt']) && isset($_POST['livr'])){
	$idTroc=$_POST['idtroc'];
	$idProduit=$_POST['pdt'];
	$idLivr=$_POST['livr'];
	$troc = new Troc();
	$trocFinal = $troc->finalisationTroc($idTroc, $idProduit, $idLivr);
	
	echo "<h1><center>Votre troc a bien été pris en compte.</center></h1>";
	echo "Un mail vous sera envoyé avec les coordonnées de la personne à qui envoyer votre objet troqué.";
}


?>