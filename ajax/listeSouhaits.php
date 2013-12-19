<?php

require_once("../Classes/Troc.php");
require_once("../Classes/Produit.php");
require_once("../Classes/Utilisateur.php");
$user = new Utilisateur();
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
		echo '<table>
				<tr bgcolor="#99275a">
					<td align="center">
						<font color="white">Souhait n°</font>
					</td>
					<td align="center">
						<font color="white">Objet ciblé</font>
					</td>
					<td align="center">
						<font color="white">Propriétaire</font>
					</td>
					<td align="center">
						<font color="white">Produits proposés en échange</font>
					</td>
					<td align="center">
						<font color="white">Date du souhait</font>
					</td>
				</tr>';
				
		foreach($tableauSouhait as $ligne){
			echo '<tr>
					<td align="center">'.$i.'</td><td>';
			if($ligne['PHOTO_PDT']!=null)
				echo '<img src="Resources/PhotosTroc/'.$ligne['PHOTO_PDT'].'" width="80" />';
			else
				echo '<img src="Resources/images/no_image.jpg" />';		
			echo '</td>
					<td align="center">'.$ligne['PRENOM'].'</a></td><td align="center">';
			if(isset($ligne['ECHANGE'])){
				foreach($ligne['ECHANGE'] as $echange){
				if($echange['PHOTO_PDT']!=null)
					echo '<img src="Resources/PhotosTroc/'.$echange['PHOTO_PDT'].'" width="80" />';
				else
					echo '<img src="Resources/images/no_image.jpg" />';		
				}
			}		
			echo '</td>
					<td align="center">'.$ligne['DATE_PROPOSITION'].'</td><td>';		
			?>
			
			<div class='annuler_souhait' id='annuler_souhait' style="position:relative; width:175px;">
				<a class="btn_anul" id="<?php echo $ligne['TROC_ID'] ?>" >
			<img src="Resources/images/annuler_souhait.png" width="175" /></a>
			</div>
				</td>
			</tr>
			
			<?php			
			$i++;
			
		}
		echo '</table>';
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
		echo '<table>
				<tr bgcolor="#99275a">
					<td align="center">
						<font color="white">Souhait n°</font>
					</td>
					<td align="center">
						<font color="white">Objet ciblé</font>
					</td>
					<td align="center">
						<font color="white">Personne interessée</font>
					</td>
					<td align="center">
						<font color="white">Produits proposés en échange</font>
					</td>
					<td align="center">
						<font color="white">Date du souhait</font>
					</td>
				</tr>';
		foreach($tableauSouhait as $ligne){
			echo '<tr>
					<td align="center">'.$i.'</td><td>';
			if($ligne['PHOTO_PDT']!=null)
				echo '<img src="Resources/PhotosTroc/'.$ligne['PHOTO_PDT'].'" width="80" />';
			else
				echo '<img src="Resources/images/no_image.jpg" />';		
			echo '</td>
					<td align="center"><a class="proprio" data-proprio = "'.$ligne['ID_EMETTEUR'].'">'.$ligne['PRENOM'].'</a></td><td align="center">';
			if(isset($ligne['ECHANGE'])){
				foreach($ligne['ECHANGE'] as $echange){
				if($echange['PHOTO_PDT']!=null)
					echo '<img src="Resources/PhotosTroc/'.$echange['PHOTO_PDT'].'" width="80" />';
				else
					echo '<img src="Resources/images/no_image.jpg" />';		
				}
			}		
			echo '</td>
					<td align="center">'.$ligne['DATE_PROPOSITION'].'</td><td>';		
			?>
			<div class='finaliser_souhait' id='finaliser_souhait'>
				<a class="btn_final"></a>
				<img src="Resources/images/troc.png" width = "175"/></a>
			</div>
			<div class='annuler_souhait' id='annuler_souhait' style="position:relative; width:175px;">
				<a class="btn_anul" id="<?php echo $ligne['TROC_ID'] ?>" >
			<img src="Resources/images/annuler_souhait.png" width="175" /></a>
			</div>
				</td>
			</tr>
			
			<?php			
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