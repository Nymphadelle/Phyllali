<?php 
session_start();
require_once '../Classes/Produit.php';
require_once '../Classes/Categorie.php';
$id_categ = $_GET['id_categ'];

$donnees = new Produit();
$produits = $donnees->getProduitsParCategorie($id_categ,$_SESSION['id']);
$donnees = new Categorie();
?>

	<h2> <?php echo $donnees->getLibelle($id_categ);?> </h2>
	<?php
		if (count($produits) == 0)
			echo 'Aucun produit dans cette sous cat&eacute;gorie.';
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