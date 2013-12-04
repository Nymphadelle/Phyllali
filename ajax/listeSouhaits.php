<?php

require_once("../Classes/Troc.php");
session_start();
$id_util = $_SESSION['id'];

/*if(isset($mesSouhaits){
	
}*/

$troc = new Troc();
$tableauSouhait=$troc->getMesSouhaits($id_util);

echo "Produit ciblé : ".$tableauSouhait[0]['LIBELLE_PDT']."<br>";
echo "Propriétaire de l'objet : ".$tableauSouhait[0]['PRENOM']."<br>";
echo "Date du souhait : ".$tableauSouhait[0]['DATE_PROPOSITION']."<br>";
echo "Produits proposés à l'échange : <br>";
for($i=1;$i<count($tableauSouhait); $i++){
	echo "<li>".$tableauSouhait[$i]['LIBELLE_PDT']."</li><br>";
}

?>