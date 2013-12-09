
<?php

require_once 'Connect.php';

class Produit extends Connect{

	public function insertProduct($cat,$user,$libelle,$description,$etat,$delai,$photo){
		/* $sql = "SELECT ID_VILLE FROM VILLE WHERE NOM_VILLE='".strtoupper($ville)."' AND CODE_POSTAL_=".$cp."";
		$ret = $this->executerRequete($sql);
		$indiceVille = odbc_result($ret,'ID_VILLE');
		
		// si la ville n'existe pas on insère
		if ( $indiceVille == '' ) {
			// on insère 
			$sql = "INSERT INTO VILLE(NOM_VILLE,CODE_POSTAL_) VALUES ('".strtoupper($ville)."', ".$cp.");";
			$this->executerRequete($sql);
			// obtenir le max de l'indice actuel
			$sql = "SELECT MAX(ID_VILLE) as ID FROM VILLE";
			$ret = $this->executerRequete($sql);
			$indiceVille = odbc_result($ret,'ID');
		}
		 */
		// on insère l'utilisateur
		
		$sql = "INSERT INTO PORDUIT (ID_CATEGORIE,UTIL_ID,LIBELLE_PDT,DESCRIPTION,DATE_FIN,ETAT,PHOTO_PDT) VALUES (".$cat.",".$user.",'".$libelle."','".$description."','now()','".$etat."','".$photo."');";
		$this->executerRequete($sql);
		//$sql = "SELECT MAX(UTIL_ID) as ID FROM UTILISATEUR";
		//$ret = $this->executerRequete($sql);
		//$indiceUtil = odbc_result($ret,'ID');
		
		// on insère ses identifiants de connexion
		//$sql = "INSERT INTO CONNEXION (mail,mdp,util) VALUES ('".$mail."','".$mdp."',".$indiceUtil.");";
		//$this->executerRequete($sql);
	}
	
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
		$sql = "select PDT_ID,PRODUIT.ID_CATEGORIE, NOM_CATEG, PRODUIT.UTIL_ID, mail,";
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
	
	public function getName($id_pdt){
		$sql = "Select LIBELLE_PDT from PRODUIT where PDT_ID=".$id_pdt;
		$produit = $this->executerRequete($sql);
		return odbc_result($produit,'LIBELLE_PDT');
	}
	
	public function getProduitsActifsFromUtil($id_util){
		$sql = "Select * from PRODUIT, PRODUIT_ACTIF where ";
		$sql .= " PRODUIT_ACTIF.PDT_ID= PRODUIT.PDT_ID AND ";
		$sql .= " PRODUIT_ACTIF.UTIL_ID = ".$id_util;
	
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
	
	public function getPoids() {
		$sql = "select PDT_ID,POIDS_APPAIRAGE from PRODUIT";
		$produits = $this->executerRequete($sql);
		$tab = array();
		$lettre = 'a';
		while(odbc_fetch_row($produits)){
			$tableau = array();		
			for($i=1;$i<=odbc_num_fields($produits);$i++){
				$tableau[odbc_field_name ( $produits, $i )] =odbc_result($produits,$i);
				$tableau['lettre'] = $lettre;
				
			}
			array_push($tab, $tableau);
			$lettre++;
		}
		return $tab;
	}
	
	public function insertCouple($p1,$p2) {
		$sql = "insert into COUPLES_PRODUITS(P1,P2) VALUES ($p1,$p2)";
		$produits = $this->executerRequete($sql);
	}
}


?>