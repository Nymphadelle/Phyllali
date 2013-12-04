<script type="text/javascript" src="Resources/javascript.js?v=<?php echo rand();?>"></script>
<?php 
require_once '../Classes/Produit.php';
require_once '../Classes/Categorie.php';
$id_categ = $_GET['id_categ'];

$donnees = new Produit();
$produits = $donnees->getProduitsParCategorie($id_categ);

$donnees = new Categorie();
$sousC= $donnees->getSousCategories($id_categ);

?>

<div class="sous_C">
<h2> Sous categories </h2>

<ul>
<?php
	foreach($sousC as $cat){
		echo '<li> <a class="sous_cat" id="'.$cat['ID_CATEGORIE'].'">'.$cat['NOM_CATEG'].'</a></li>';
	}
	
?>
</ul>


</div>

<div class = "Aff_Produits">

	<?php
		foreach($produits as $produit){
			?>
			<div class="vignette" id=<?php echo $produit['PDT_ID']?>>
			<?php
			if($produit['PHOTO_PDT']!=null){
			
				echo '<img src="Resources/PhotosTroc/'.$produit['PHOTO_PDT'].'" width="125" />';
			}else{
				echo '<img src="Resources/images/no_image.jpg" />';
			}
			
			echo $produit['LIBELLE_PDT']."</br>";
			?>
			</div>
			<?php

		}
	?>
</div>
