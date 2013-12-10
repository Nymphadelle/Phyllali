
<?php

require_once 'Connect.php';
header('Content-Type: text/html; charset=iso-8859-1');
class Categorie extends Connect{


//propriétés





//renvoie la liste des produits
public function getCategories(){
	
	$sql ='select * from CATEGORIE where CAT_ID_CATEGORIE IS NULL';
	$categories = $this->executerRequete($sql);
	
	$tableau = array();
	while(odbc_fetch_row($categories)){
		$tabAtt = array();		
			for($i=1;$i<=odbc_num_fields($categories);$i++){
				$tabAtt[odbc_field_name ( $categories, $i )] =odbc_result($categories,$i);
			}
			array_push($tableau, $tabAtt);
	}
	return $tableau;
}

public function getSousCategories($id_categ){
	
	$sql ='select * from CATEGORIE where CAT_ID_CATEGORIE = '.$id_categ;
	$categories = $this->executerRequete($sql);
	
	$tableau = array();
	while(odbc_fetch_row($categories)){
		$tabAtt = array();		
			for($i=1;$i<=odbc_num_fields($categories);$i++){
				$tabAtt[odbc_field_name ( $categories, $i )] =odbc_result($categories,$i);
			}
			array_push($tableau, $tabAtt);
	}
	return $tableau;
}

public function getLibelle($id) {
	$sql = 'select ID_CATEGORIE,NOM_CATEG from CATEGORIE ID_CATEGORIE WHERE ID_CATEGORIE = '.$id;
	$categorie = $this->executerRequete($sql);	
	return (odbc_result ( $categorie, 'NOM_CATEG' ));
}
	
}
?>