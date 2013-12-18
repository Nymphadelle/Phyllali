<?php 
	session_start();
	require_once '../Classes/Produit.php';
	require_once '../Classes/Utilisateur.php';
	require_once '../Classes/ModeLivraison.php';
	$id_pdt_voulu = $_GET['idPdtVoulu'];
	$id_util_vise = $_GET['util_id'];
	$pdt = new Produit();
	$name_pdt = $pdt->getName($id_pdt_voulu);
	
	$util = new Utilisateur();
	$name_util = $util->getName($id_util_vise);
	
	$donnees = new ModeLivraison();
	$modes = $donnees->getModes();
	//var_dump ($modes);
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
			<div class="vignette_souhait" id=<?php echo $produit['PDT_ID']?>>
			<form name="Form" action="ajax/souhaitFini.php" method="GET">
			<?php
			if($produit['PHOTO_PDT']!=null){
			
				echo '<img src="Resources/PhotosTroc/'.$produit['PHOTO_PDT'].'" height="125" width="125" />';
			}else{
				echo '<img src="Resources/images/no_image.jpg" />';
			}
			
			echo '<input type="checkbox" class="check_pdt" value="'.$produit['PDT_ID'].'">';
			echo $produit['LIBELLE_PDT']."</br>";
			echo "</div>";
			}
			?>
		
			</div>
			
			<div class="mode_livraison" style ="margin-top :200px;width:500px; height:50px;" >
			<h2> Choisissez vos possibilit&eacutes de mode de livraison </h2>
			<?php foreach($modes as $mode){
			
			echo '<input type="checkbox" class="check_modes" value="'.$mode['MODE_LIVR_ID'].'">';
			echo $mode['NOM_TYPE_L']."</br>";
			
			}
			?>
		

	


			<div class='valid_s' id='valider_souhait' style="position:absolute">
			
		
			<a ><img src="Resources/images/valider_souhait.png" width="175" /></a>
			</div>
				</div>
			</form>	
			
		</div>