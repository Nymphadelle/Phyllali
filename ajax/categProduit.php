<?php 
require_once '../Classes/Produit.php';
$id_categ = $_GET['id_categ'];

$donnees = new Produit();
$produits = $donnees->getProduitsParCategorie($id_categ);







	foreach($produits as $produit){

	echo "Nom du produit : ".$produit['LIBELLE_PDT']."</br>";


	}
?>