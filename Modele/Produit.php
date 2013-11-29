
<?php

require_once 'Modele/Modele.php';

class Produit extends Modele{

//renvoie la liste des produits
public function getProduits(){
	$sql ='select * from PRODUIT';
	$produits = $this->executerRequete($sql);
	return $produits;
}

}
?>