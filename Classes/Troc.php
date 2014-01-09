<?php
require_once 'Connect.php';

class Troc extends Connect{


/*xxxxxxxxx METHODES xxxxxxxxxx*/
	
	public function getMesSouhaits($id_util){
		$sql = "SELECT TROC_ID, LIBELLE_PDT, PRENOM, DATE_PROPOSITION, PHOTO_PDT FROM PRODUIT_ACTIF, UTILISATEUR, TROC, PRODUIT  ";
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
			$sql2 = "SELECT TROC_ID, LIBELLE_PDT, PHOTO_PDT FROM PRODUIT, PROPOSE WHERE TROC_ID=".$id." AND PRODUIT.PDT_ID=PROPOSE.PDT_ID AND PROPOSE.UTIL_ID =".$id_util."";
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
		$sql="SELECT ID_CIBLE, ID_EMETTEUR, TROC_ID, LIBELLE_PDT, PRENOM, DATE_PROPOSITION,PHOTO_PDT FROM PRODUIT_ACTIF, UTILISATEUR, TROC, PRODUIT ";
		$sql .="WHERE ID_CIBLE = ".$id_util." AND PRODUIT_ACTIF.PDT_ID = ID_PROD_VOULU ";
		$sql .="AND PRODUIT.PDT_ID = PRODUIT_ACTIF.PDT_ID AND UTILISATEUR.UTIL_ID = ID_EMETTEUR ORDER BY PRODUIT_ACTIF.PDT_ID";
		$ret= $this->executerRequete($sql);
		$id_troc=array();
		$tableauSouhait=array();
		$tableauProduits=array();
		while($ligne=odbc_fetch_array($ret)){
			array_push($id_troc,odbc_result($ret,'TROC_ID'));
			array_push($tableauSouhait, $ligne);
		}
		foreach($id_troc as $id){
			$sql2 = "SELECT TROC_ID, LIBELLE_PDT, PRODUIT.PDT_ID,PHOTO_PDT FROM PRODUIT, PROPOSE WHERE TROC_ID=".$id." AND PRODUIT.PDT_ID=PROPOSE.PDT_ID";
			$ret2=$this->executerRequete($sql2);
			while($row = odbc_fetch_array($ret2)){
				array_push($tableauProduits, $row);
			}
		}
		for($i=0; $i<count($tableauSouhait); $i++){
			for($j=0; $j<count($tableauProduits); $j++){
				echo "<br>";
				echo "<br>";
				if($tableauProduits[$j]['TROC_ID'] == $tableauSouhait[$i]['TROC_ID']){
					$tableauSouhait[$i]['ECHANGE']= $tableauProduits;
				}
			}
		}
		
		
		return $tableauSouhait;
	}
	
	public function getHistorique($id) {
		$sql = "select TROC_H_ID,datediff(hh,DATE_TRANSACTION,getdate()) as HEURES,YEAR(DATE_TRANSACTION) as ANNEE, MONTH(DATE_TRANSACTION) as MOIS, DAY(DATE_TRANSACTION) as JOUR, MODE_LIVRAISON,COM_UTILI_CIBLE as com, ID_PROD_VOULU, ID_PROD_PROPOSE, ID_EMETTEUR, ID_CIBLE 
				from TROC_HISTORIQUE WHERE ID_EMETTEUR = ".$id." AND ID_PROD_PROPOSE IS NOT NULL ORDER BY HEURES";
		$ret= $this->executerRequete($sql);
		$tableau=array();
		while($ligne=odbc_fetch_array($ret)){
			array_push($tableau, $ligne);
		}
		
		$sql = "select TROC_H_ID,datediff(hh,DATE_TRANSACTION,getdate()) as HEURES,YEAR(DATE_TRANSACTION) as ANNEE, MONTH(DATE_TRANSACTION) as MOIS, DAY(DATE_TRANSACTION) as JOUR, MODE_LIVRAISON,COM_UTILI_INIT as com, ID_PROD_VOULU as ID_PROD_PROPOSE, ID_PROD_PROPOSE as ID_PROD_VOULU, ID_EMETTEUR as ID_CIBLE, ID_CIBLE as ID_EMETTEUR 
				from TROC_HISTORIQUE WHERE ID_CIBLE = ".$id." AND MODE_LIVRAISON IS NOT NULL ORDER BY HEURES";
		$ret= $this->executerRequete($sql);	
		while($ligne=odbc_fetch_array($ret)){
			array_push($tableau, $ligne);
		}		
		return $tableau;
	}
	
	
	public function ajouterSouhait($id_emetteur,$id_cible,$id_pdt_voulu,$date,$liste_pdts,$liste_md){
		$sql="BEGIN TRANSACTION ajouterSouhait ";
		$sql.="exec ajout_souhait ".$id_emetteur.",".$id_cible.",".$id_pdt_voulu ;
		$sql.=",".$date.",".$liste_pdts.",".$liste_md." ";
		$sql.=" if( @@error != 0) ROLLBACK else";
		$sql .=" COMMIT TRANSACTION ";
		//echo $sql;
		$ret= $this->executerRequete($sql);
	}
	
	
	public function deleteTroc($id_troc){
		$sql="BEGIN TRANSACTION deleteSouhait ";
		$sql.="exec deleteSouhait ".$id_troc;
		$sql.=" if( @@error != 0) ROLLBACK else";
		$sql .=" COMMIT TRANSACTION ";
		//echo $sql;
		$ret= $this->executerRequete($sql);
	}
	
	public function ajouterNote($idcible,$id,$com,$note,$troc){
		$sql = "INSERT INTO NOTE(TROC_H_ID,UTIL_ID,UTI_UTIL_ID,NOTE,COMMENTAIRE,DATE) values (".$troc.",".$id.",".$idcible.",".$note.",'".$com."',getdate())";
		$ret= $this->executerRequete($sql);
		echo $sql.'   ';
		
		echo 'id cible = '.$id.', id session = '.$_SESSION['id'];
		
		// est ce que je suis proprio du roduit ?
		$sql = "select * FROM TROC_HISTORIQUE WHERE ID_PROD_VOULU IN ( select PDT_ID FROM PRODUIT WHERE UTIL_ID = ".$_SESSION['id']." ) AND TROC_H_ID = ".$troc;
		$ret= $this->executerRequete($sql);
		$tableau=array();
		while($ligne=odbc_fetch_array($ret)){
			array_push($tableau, $ligne);
		}
		if (count($tableau)==0)
			$sql = "UPDATE TROC_HISTORIQUE set COM_UTILI_INIT=1 WHERE TROC_H_ID=".$troc;
		else
			$sql = "UPDATE TROC_HISTORIQUE set COM_UTILI_CIBLE=1 WHERE TROC_H_ID=".$troc;

		$ret= $this->executerRequete($sql);
		echo $sql;
	}	
	public function finalisationTroc($idtroc, $idpdt, $mode_livr){
		$sql = "exec finalisation_troc ".$idtroc.", ".$idpdt.",'".$mode_livr."'";		$finalisation = $this->executerRequete($sql);
	}
}