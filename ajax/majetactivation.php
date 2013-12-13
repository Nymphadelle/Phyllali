<?php
session_start();
require_once '../Classes/Produit.php';
$produit = new Produit();
$produit->activatePdt($_SESSION['pdtid'],$_SESSION['id'],$_POST['etat'],$_POST['description'],$_POST['delai']);
header('Location: ../index.php');

?>
