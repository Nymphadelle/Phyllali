
<?php

require_once 'Connect.php';

class Categorie extends Connect{


//propri�t�s





//renvoie la liste des produits
public function getCategories(){
	
	$sql ='select * from CATEGORIE';
	$categories = $this->executerRequete($sql);
	
	$tableau = array();
	while(odbc_fetch_row($categories)){
		array_push($tableau, odbc_result($categories,3));
	}
	return $tableau;
}

}
?>