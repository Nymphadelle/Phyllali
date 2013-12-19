<?php 
	session_start();
	require_once '../Classes/Troc.php';
	$troc = new Troc();

	$id_cible = $_SESSION['id_util_vise']; 
	$id_pdt_voulu= $_SESSION['id_pdt_voulu']; 
	$id_emetteur = $_SESSION['id']; 


	$tab = array();	
	$liste_pdts = "'";
	$liste_md="'";
	

	//si la liste des produits n'est pas vide
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
		$liste_pdts.="'";
		//var_dump ($liste_pdts);
		
		//si la liste des md de livraison pas vide
		if(isset($_POST['liste_modes'])){
			$tab = $_POST['liste_modes'];
			$i=0;
			for($i=0; $i<sizeof($tab);$i++){
				if($i==0){
					$liste_md.=$tab[$i];
				}else{
					$liste_md.=",".$tab[$i];
				}
			}
			$liste_md.="'";

			$date = "'".date("m-d-y")."'";
	
			$rep = $troc->ajouterSouhait($id_emetteur,$id_cible,$id_pdt_voulu,$date,$liste_pdts,$liste_md);
		}
	}
	

?>

<h2>Vous avez valid&eacute votre souhait</h2></br>
<a href="index.php"> Revenir sur la page d'accueil </a>