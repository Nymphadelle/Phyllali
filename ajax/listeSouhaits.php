<?php

require_once("../Classes/Troc.php");
require_once("../Classes/Produit.php");
session_start();
$id_util = $_SESSION['id'];
if(isset($_POST['souhaits'])){
	$mesSouhaits=$_POST['souhaits'];
}
?>
	<div id='ListerSouhaits'>
	<a class = 'mesSouhaits' data-type='1' title='Afficher mes demandes de troc'><img src="Resources/images/in.png" width="150"></a>
	<a class ='mesSouhaits' data-type='0' title='Afficher les souhaits sur mes produits'><img src="Resources/images/out.png" width="150"></a>
	<a class ='mesSouhaits' data-type='2' title='Afficher mes produits'><img src="Resources/images/prod.png" width="150"></a>
	</div>
	
<?php
//si suppression
if(isset($mesSouhaits) && $mesSouhaits == 3){

	if(isset($_POST['id_troc'])){
	$id = $_POST['id_troc'];
	$troc = new Troc();

	$troc->deleteTroc($id);
	//on va recharger les souhaits
	$mesSouhaits = 1;
}

}

echo "<div class='Aff_Produits'>";

if(isset($mesSouhaits) && $mesSouhaits == 1){
	echo "<h2>Liste de vos demandes de troc</h2>";
	$i=1;
	$troc = new Troc();
	$tableauSouhait=$troc->getMesSouhaits($id_util);
	if(!empty($tableauSouhait)){
		foreach($tableauSouhait as $ligne){
			echo "<b>Souhait n°".$i."</b><br>";
			echo "Objet ciblé : ".$ligne['LIBELLE_PDT']."<br>";
			echo "Propriétaire de l'objet : ".$ligne['PRENOM']."<br>";
			echo "Date du souhait : ".$ligne['DATE_PROPOSITION']."<br>";
			echo "Produits proposés à l'échange : </br>";
			if(isset($ligne['ECHANGE'])){
				foreach($ligne['ECHANGE'] as $echange){
					echo $echange['LIBELLE_PDT']."<br>";
				}
			}
			
			?>
			<div class='annuler_souhait' id='annuler_souhait' style="position:relative; width:175px;">
			<a class="btn_anul" id="<?php echo $ligne['TROC_ID'] ?>" >
			<img src="Resources/images/annuler_souhait.png" width="175" /></a>
			</div>
			
			<?php
			
			echo "<br>";
			
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
	echo "<h2>Liste des demandes de troc sur vos objets</h2>";
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
else if(isset($mesSouhaits) && $mesSouhaits == 2){
	$produit = new Produit();
	$prodActifs = $produit->getProduitsActifsFromUtil($_SESSION['id']);
	echo "<h2>Vos produits actuellements actifs</h2>";
	if (count($prodActifs) > 0) {
		foreach($prodActifs as $prods) { ?>
			<div class="pdtactif">
				<table>
					<tr>
						<td align="center">
							<?php echo $prods['LIBELLE_PDT']; ?>
						</td>
					</tr>
					<tr>
						<td>
							<img src="Resources/PhotosTroc/<?php echo $prods['PHOTO_PDT'];?>" width='150'>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $prods['DESCRIPTION']; ?>
						</td>
					</tr>
					<tr>
						<td>
							actif jusqu'au : <?php echo $prods['DATE_FIN']; ?>
						</td>
					</tr>
				</table>
			</div>
		<?php }
	}
	else
		echo 'Aucun produits actifs';
}
echo "</div>";


?>