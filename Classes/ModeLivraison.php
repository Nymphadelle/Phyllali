
<?php
require_once 'Connect.php';

class ModeLivraison extends Connect{
	public function getModes(){
		$sql = "SELECT * from MODE_LIVRAISON";
		$modes = $this->executerRequete($sql);
		
		
		$tab = array();
		while(odbc_fetch_row($modes)){
			$tableau = array();		
			for($i=1;$i<=odbc_num_fields($modes);$i++){
				$tableau[odbc_field_name ( $modes, $i )] =odbc_result($modes,$i);

			}
			array_push($tab, $tableau);
		}
		return $tab;
	}
	
	public function getLivraison($troc_id){
		$sql = "SELECT MODE_LIVRAISON.MODE_LIVR_ID, NOM_TYPE_L FROM MODE_LIVRAISON, POSSEDE WHERE TROC_ID=".$troc_id." AND POSSEDE.MODE_LIVR_ID = MODE_LIVRAISON.MODE_LIVR_ID";
		$modes = $this->executerRequete($sql);
		$tab = array();
		while(odbc_fetch_row($modes)){
			$tableau = array();		
			for($i=1;$i<=odbc_num_fields($modes);$i++){
				$tableau[odbc_field_name ( $modes, $i )] =odbc_result($modes,$i);

			}
			array_push($tab, $tableau);
		}
		return $tab;
	}

	
}?>