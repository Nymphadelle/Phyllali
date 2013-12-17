<?php
require_once 'Connect.php';

class Troc extends Connect{


/*xxxxxxxxx METHODES xxxxxxxxxx*/
	
	public function getMesSouhaits($id_util){
		$sql = "SELECT TROC_ID, LIBELLE_PDT, PRENOM, DATE_PROPOSITION FROM PRODUIT_ACTIF, UTILISATEUR, TROC, PRODUIT  ";
		$sql .= " WHERE ID_EMETTEUR=".$id_util." AND PRODUIT_ACTIF.PDT_ID = ID_PROD_VOULU ";
		$sql .= " AND PRODUIT.PDT_ID = PRODUIT_ACTIF.PDT_ID AND UTILISATEUR.UTIL_ID = ID_CIBLE";
		$ret = $this->executerRequete($sql);
		$id_troc=array();
		$tableauSouhait=array();
		$tableauProduits=array();
		while($ligne=odbc_fetch_array($ret)){
			array_push($id_troc,odbc_result($ret,'TROC_ID'));
			array_push($tableauSouhait, $ligne);
		}
		foreach($id_troc as $id){
			$sql2 = "SELECT TROC_ID, LIBELLE_PDT FROM PRODUIT, PROPOSE WHERE TROC_ID=".$id." AND PRODUIT.PDT_ID=PROPOSE.PDT_ID AND PROPOSE.UTIL_ID =".$id_util."";
			$ret2=$this->executerRequete($sql2);
			while($row = odbc_fetch_array($ret2)){
				array_push($tableauProduits, $row);
			}
		}
		
		
		for($i=0; $i<count($tableauSouhait); $i++){
			for($j=0; $j<count($tableauProduits); $j++){
				if($tableauProduits[$j]['TROC_ID'] == $tableauSouhait[$i]['TROC_ID']){
					$tableauSouhait[$i]['ECHANGE']= $tableauProduits;
				}
			}
		}
		
		
		return $tableauSouhait;
		
	}
	
	public function getLeursSouhaits($id_util){
		$sql="SELECT ID_CIBLE, TROC_ID, LIBELLE_PDT, PRENOM, DATE_PROPOSITION FROM PRODUIT_ACTIF, UTILISATEUR, TROC, PRODUIT ";
		$sql .="WHERE ID_CIBLE = ".$id_util." AND PRODUIT_ACTIF.PDT_ID = ID_PROD_VOULU ";
		$sql .="AND PRODUIT.PDT_ID = PRODUIT_ACTIF.PDT_ID AND UTILISATEUR.UTIL_ID = ID_EMETTEUR";
		$ret= $this->executerRequete($sql);
		$id_troc=array();
		$tableauSouhait=array();
		$tableauProduits=array();
		while($ligne=odbc_fetch_array($ret)){
			array_push($id_troc,odbc_result($ret,'TROC_ID'));
			array_push($tableauSouhait, $ligne);
		}
		foreach($id_troc as $id){
			$sql2 = "SELECT TROC_ID, LIBELLE_PDT FROM PRODUIT, PROPOSE WHERE TROC_ID=".$id." AND PRODUIT.PDT_ID=PROPOSE.PDT_ID";
			$ret2=$this->executerRequete($sql2);
			while($row = odbc_fetch_array($ret2)){
				array_push($tableauProduits, $row);
			}
		}
		for($i=0; $i<count($tableauSouhait); $i++){
			for($j=0; $j<count($tableauProduits); $j++){
				if($tableauProduits[$j]['TROC_ID'] == $tableauSouhait[$i]['TROC_ID']){
					$tableauSouhait[$i]['ECHANGE']= $tableauProduits;
				}
			}
		}
		
		
		return $tableauSouhait;
		
	}
	
	public function ajouterSouhait($id_emetteur,$id_cible,$id_pdt_voulu,$date,$liste_pdts,$liste_md){
	$sql="INSERT INTO TEMP_MD_LIV (id_string, id_util) VALUES (1,1)";
	$ret= $this->executerRequete($sql);
	}
}