<?php 

session_start();
require_once '../Classes/Produit.php';

$id_pdt = $_GET['id_pdt'];

$donnee = new Produit();
$produit = $donnee->getProduitParId($id_pdt);

?>
