<?php 
	session_start();
	require_once '../Classes/Produit.php';
	require_once '../Classes/Utilisateur.php';
	$id_pdt_voulu = $_GET['idPdtVoulu'];
	$id_util_vise = $_GET['util_id'];
	$pdt = new Produit();
	$name_pdt = $pdt->getName($id_pdt_voulu);
	
	$util = new Utilisateur();
	$name_util = $util->getName($id_util_vise);
	
	if(isset($_SESSION['id'])){
		$mes_produits = $pdt->getProduitsActifsFromUtil($_SESSION['id']);
	}
	$_SESSION['id_pdt_voulu'] = $id_pdt_voulu;
	$_SESSION['id_util_vise'] = $id_util_vise;
	
?>
	<div id="fiche" style="width:500px; height:500px;  ">
		
			<?php
			
			echo "Echanger l'objet ".$name_pdt." de ".$name_util." contre :";
			
			?>
			<h2> Liste de mes produits </h2>
			<div class = "Aff_Produits">

		<?php
		foreach($mes_produits as $produit){
			?>
			<div class="vignette" id=<?php echo $produit['PDT_ID']?>>
			<form name="Form" action="ajax/souhaitFini.php" method="GET">
			<?php
			if($produit['PHOTO_PDT']!=null){
			
				echo '<img src="Resources/PhotosTroc/'.$produit['PHOTO_PDT'].'" width="125" />';
			}else{
				echo '<img src="Resources/images/no_image.jpg" />';
			}
			
			
			
			
			?>
		
			</div>
			
			<?php
			echo '<input type="checkbox" class="check_pdt" value="'.$produit['PDT_ID'].'">';
			echo $produit['LIBELLE_PDT']."</br>";

		}
	?>
	</br>
	
</div>
			<input type="button" id="valider_souhait" value="valider le souhait">
			</form>	
			
		</div>