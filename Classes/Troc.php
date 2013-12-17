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
	
	public function getHistoriqueEmetteur($id) {
		$sql = "select datediff(hh,DATE_TRANSACTION,getdate()) as HEURES,YEAR(DATE_TRANSACTION) as annee, MONTH(DATE_TRANSACTION) as MOIS, DAY(DATE_TRANSACTION) as JOUR, MODE_LIVRAISON,COM_UTILI_INIT,COM_UTILI_CIBLE, ID_PROD_VOULU, ID_PROD_PROPOSE, ID_EMETTEUR, ID_CIBLE from TROC_HISTORIQUE WHERE ID_EMETTEUR = 18 ORDER BY HEURES";
		echo $sql;
		$ret= $this->executerRequete($sql);
		$tableau=array();
		while($ligne=odbc_fetch_array($ret)){
			array_push($tableau, $ligne);
		}
		return $tableau;
	}
	
	public function getHistoriqueCible($id) {
		$sql = "select datediff(hh,DATE_TRANSACTION,getdate()) as HEURES,DATE_TRANSACTION, MODE_LIVRAISON,COM_UTILI_INIT,COM_UTILI_CIBLE, ID_PROD_VOULU, ID_PROD_PROPOSE, ID_EMETTEUR, ID_CIBLE from TROC_HISTORIQUE  WHERE ID_CIBLE = ".$id;
		//echo $sql;
	}
}