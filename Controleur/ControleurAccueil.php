<?php

require_once 'Modele/Produit.php';
require_once 'Vue/Vue.php';

class ControleurAccueil{

private $produits;

public function __construct(){
	$this->produits = new Produit();
}	
// Affiche le blog et ses catégories
public function accueil() {
	$liste  = $this->produits->getProduits();
	$vue = new Vue("Accueil");
 $vue->generer(array('produits' =>$liste));
}

}
?>