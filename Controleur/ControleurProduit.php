<?php

require_once 'Modele/Produit.php';
require_once 'Vue/Vue.php';

class ControleurProduit{

private $produit;

public function __construct(){
	$this->produit = new Produit();
}	
// Affiche le blog et ses catégories
function produit() {
	//$produits  = getProduits();
	//$vue = new Vue("Produit");
 //$vue->generer(array('produits' =>$produits));
}

}

?>