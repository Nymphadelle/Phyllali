<?php 
session_start();

require_once '../Classes/Troc.php';
$troc = new Troc();

$id_cible = $_SESSION['id_util_vise']; 
$id_pdt_voulu= $_SESSION['id_pdt_voulu']; 
$id_emetteur = $_SESSION['id']; 


$tab = array();	
$liste_pdts = "";
$liste_md="1,2";
if (isset($_POST['liste_pdts'])){
$tab = $_POST['liste_pdts'];
$i=0;
	for($i=0; $i<sizeof($tab);$i++){
		if($i==0){
			$liste_pdts.=$tab[$i];
		}else{
			$liste_pdts.=",".$tab[$i];
		}
	}
var_dump ($liste_pdts);
	$date = date("d-m-y");
echo $date;

$rep = $troc->ajouterSouhait($id_emetteur,$id_cible,$id_pdt_voulu,$date,$liste_pdts,$liste_md);

}else{
echo "aucun pdt selectionné";
}


?>

<h2>Voici les produits que vous venez de proposer :</h2>