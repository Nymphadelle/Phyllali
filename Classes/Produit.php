
<?php

require_once 'Connect.php';

class Produit extends Connect{

	//renvoie la liste des produits
	public function getProduits(){
		$sql ='select * from PRODUIT';
		$produits = $this->executerRequete($sql);
		$tab = array();
		while(odbc_fetch_row($produits)){
			$tableau = array();		
			for($i=1;$i<=odbc_num_fields($produits);$i++){
				$tableau[odbc_field_name ( $produits, $i )] =odbc_result($produits,$i);
			}
			array_push($tab, $tableau);
		}
		return $tab;
	}
		
	//renvoie la liste des produits
	public function getProduitsParCategorie($id_categ){
		$sql ='select * from PRODUIT WHERE PDT_ID  IN (SELECT PDT_ID from PRODUIT_ACTIF)';
		$sql .= 'AND  (ID_CATEGORIE IN (SELECT ID_CATEGORIE FROM CATEGORIE ';
		$sql .= 'where CAT_ID_CATEGORIE= '.$id_categ.') OR ID_CATEGORIE='.$id_categ.')';
		//echo $sql;
		$produits = $this->executerRequete($sql);
		$tab = array();
		while(odbc_fetch_row($produits)){
			$tableau = array();		
			for($i=1;$i<=odbc_num_fields($produits);$i++){
				$tableau[odbc_field_name ( $produits, $i )] =odbc_result($produits,$i);
			}
			array_push($tab, $tableau);
		}
		return $tab;
	}
	
	//renvoie un produit via son id
	public function getProduitParId($id_pdt){
		$sql = "select PRODUIT.ID_CATEGORIE, NOM_CATEG, PRODUIT.UTIL_ID, mail,";
		$sql .=" LIBELLE_PDT, DESCRIPTION, DATE_FIN, ETAT, PHOTO_PDT ";
		$sql .=" FROM UTILISATEUR, CONNEXION, PRODUIT, CATEGORIE" ;
		$sql .= " WHERE util = PRODUIT.UTIL_ID AND CATEGORIE.ID_CATEGORIE = ";
		$sql .= " PRODUIT.ID_CATEGORIE AND PDT_ID =".$id_pdt;
		
		$produit = $this->executerRequete($sql);
		//$tab = array();
		//while(odbc_fetch_row($produits)){
			$tableau = array();		
			for($i=1;$i<=odbc_num_fields($produit);$i++){
				$tableau[odbc_field_name ( $produit, $i )] =utf8_encode (odbc_result($produit,$i));
			}
			//array_push($tab, $tableau);
		
		return $tableau;
	}
	
}


?>