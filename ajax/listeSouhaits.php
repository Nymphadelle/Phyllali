<?php

require_once("../Classes/Troc.php");
session_start();
$id_util = $_SESSION['id'];
if(isset($_POST['souhaits'])){
	$mesSouhaits=$_POST['souhaits'];
}

echo "<div class='Aff_Produits'>";

if(isset($mesSouhaits) && $mesSouhaits == 1){

	echo "<div id='ListerSouhaits'>";
	echo "<a class = 'mesSouhaits' data-type='1'> Liste de vos demandes de troc </a>    |    ";
	echo "<a class ='mesSouhaits' data-type='0'> Liste des demandes de trocs sur vos objets </a>";
	echo "</div>";
	echo "<h1>Liste de vos demandes de troc</h1>";
	$i=1;
	$troc = new Troc();
	$tableauSouhait=$troc->getMesSouhaits($id_util);
	if(!empty($tableauSouhait)){
		foreach($tableauSouhait as $ligne){
			echo "<b>Souhait n°".$i."</b><br>";
			echo "Objet ciblé : ".$ligne['LIBELLE_PDT']."<br>";
			echo "Propriétaire de l'objet : ".$ligne['PRENOM']."<br>";
			echo "Date du souhait : ".$ligne['DATE_PROPOSITION']."<br>";
			echo "Produits proposés à l'échange :";
			if(isset($ligne['ECHANGE'])){
				foreach($ligne['ECHANGE'] as $echange){
					echo $echange['LIBELLE_PDT']."<br>";
				}
			}
			echo "<br><br>";
			$i++;
		}
	}
	else{
		echo "Aucun souhait en cours";
	}
}
else if(isset($mesSouhaits) && $mesSouhaits == 0){
	$i=1;
	$troc = new Troc();
	echo "<div id='ListerSouhaits'>";
	echo "<a class = 'mesSouhaits' data-type='1'> Liste de vos demandes de troc </a>    |    ";
	echo "<a class ='mesSouhaits' data-type='0'> Liste des demandes de trocs sur vos objets </a>";
	echo "</div>";
	echo "<h1>Liste des demandes de troc sur vos objets</h1>";
	$tableauSouhait=$troc->getLeursSouhaits($id_util);
	if(!empty($tableauSouhait)){
		foreach($tableauSouhait as $ligne){
			echo "<b>Demande n°".$i."</b><br>";
			echo "Objet ciblé :".$ligne['LIBELLE_PDT']."<br>";
			echo "Propriétaire de l'objet : <a class='proprio' data-proprio ='".$ligne['ID_EMETTEUR']."'>".$ligne['PRENOM']."</a><br>";
			echo "Date du souhait : ".$ligne['DATE_PROPOSITION']."<br>";
			echo "Produits proposés à l'échange :";
			if(isset($ligne['ECHANGE'])){
				echo "<div class = 'ObjetsEchange'>";
				foreach($ligne['ECHANGE'] as $echange){
					echo "<div class='vignette' id=".$echange['PDT_ID'].">";
					echo $echange['LIBELLE_PDT']."<br>";
					echo "</div>";
					
				}
				echo "</div>";
			}
			echo "<br>";
			echo "<div class='bouton'>";
			echo "<a class='boutonTroc' class=".$ligne['TROC_ID']."><img src='Resources/images/troc.png' width='175'></a><br><br>";
			echo "</div>";
			$i++;
		}
		}
	
	else{
		echo "Aucune demande de troc en cours";
	}
}
else{
	echo "<div id='ListerSouhaits'>";
	echo "<a class = 'mesSouhaits' data-type='1'> Liste de vos demandes de troc </a>    |    ";
	echo "<a class ='mesSouhaits' data-type='0'> Liste des demandes de trocs sur vos objets </a>";
	echo "</div>";
}
echo "</div>";


?>