<!--

// class Produit 
// {
	// public $_PDT_ID;
	// public $_ID_CATEGORIE;
	// public $_UTIL_ID;
	// public $_LIBELLE_PDT;
	// public $_DESCRIPTION;
	// public $_PHOTO;
	// public $_DATE_FIN;
	// public $_ETAT;

	// public function getPDT(){
 // echo 'test';
	// }
// }
// ?>-->

<?php

require 'Modele.php';

try {
  
      $produit = getProduits();
      require 'vueAccueil.php';
  
}
catch (Exception $e) {
  $msgErreur = $e->getMessage();
  require 'vueErreur.php';
}