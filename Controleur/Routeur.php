<?php
require_once 'Controleur/ControleurAccueil.php';
require_once 'Controleur/ControleurProduit.php';

require_once 'Vue/Vue.php';

class Routeur{

private $ctrlAccueil;
private $ctrlProduit;

public function __construct(){
	$this->ctrlAccueil = new ControleurAccueil();
	$this->ctrlProduit = new ControleurProduit();
}	


// Affiche le blog et ses catégories
public function router() {
	$this->ctrlAccueil->accueil();
}

// Affiche les produits
//function produits() {
  //$produits = getProduits($produits);
  //require 'Vue/vueProduits.php';
//}

}
?>