<?php 
require_once '../Classes/Produit.php';

$id_pdt = $_GET['id_pdt'];

$donnee = new Produit();
$produit = $donnee->getProduitParId($id_pdt);

?>

<div class="Produit">
<h2> <?php echo $produit['LIBELLE_PDT']   ?> </h2>

		<div class="img" style="width:300px;float:left; height:300px; background-color:grey; ">	
			<?php
			if($produit['PHOTO_PDT']!=null){
				echo '<img src="Resources/PhotosTroc/'.$produit['PHOTO_PDT'].'" width=300" />';
			}else{
				echo '<img src="Resources/images/no_image.jpg" />';
			}
			?>
		</div>
		<div class ="description" style="float:left;margin:15px;width:450px;">
		<?php 
		echo "Nom du produit : ".$produit['LIBELLE_PDT']."</br>"; 
		echo 'Propri&eacute;taire : <a class="proprietaire" id="'.$produit['UTIL_ID'].'">'.$produit['mail'].'</a></br>';
		echo 'Categorie : <a class="cat" id="'.$produit['ID_CATEGORIE'].'">'.$produit['NOM_CATEG'].'</a></br></br>';
		echo "Description : ".$produit['DESCRIPTION'];
		echo "</br>Etat : ".$produit['ETAT'];
		echo "</br></br>Date limite du troc : ".$produit['DATE_FIN'];
		?>
		</div>
</div>