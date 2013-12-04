<?php
require_once 'Connect.php';

class Troc extends Connect{


/*xxxxxxxxx METHODES xxxxxxxxxx*/
	
	public function getMesSouhaits($id_util){
		$sql = "SELECT TROC_ID, LIBELLE_PDT, PRENOM, DATE_PROPOSITION FROM PRODUIT_ACTIF, UTILISATEUR, TROC, PRODUIT  ";
		$sql .= " WHERE ID_EMETTEUR=".$id_util." AND PRODUIT_ACTIF.PDT_ID = ID_PROD_VOULU ";
		$sql .= " AND PRODUIT.PDT_ID = PRODUIT_ACTIF.PDT_ID AND UTILISATEUR.UTIL_ID = ID_CIBLE";
		$ret = $this->executerRequete($sql);
		
		
		$id_troc=odbc_fetch_row($ret,'TROC_ID');
		$sql2 = "SELECT LIBELLE_PDT FROM PRODUIT, PROPOSE WHERE TROC_ID=".$id_troc." AND PRODUIT.PDT_ID=PROPOSE.PDT_ID";
		$ret2=$this->executerRequete($sql2);
		
		echo $sql2;
		$tableau = array();
		while($row = odbc_fetch_array($ret)){
			array_push($tableau, $row);
		}
		print_r($tableau);
		return $tableau;
		
	}
}