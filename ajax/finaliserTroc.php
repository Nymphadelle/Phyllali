<?php 
require_once("../Classes/Troc.php");
require_once("../Classes/Produit.php");
require_once("../Classes/ModeLivraison.php");
require_once("../Classes/Utilisateur.php");

$user = new Utilisateur();
session_start();

if (isset($_POST['idtroc']) && isset($_POST['idutil'])){
	$idTroc=$_POST['idtroc'];
	$idUtil=$_POST['idutil'];
	$libellePdt=$_POST['idprod'];
}
$prod = new Produit();
$listeprod = $prod->getProduitsProposes($idTroc, $idUtil); 
$livraison = new ModeLivraison();
$listeLivraison = $livraison->getLivraison($idTroc);




?>


Finaliser le troc concernant votre objet <?php echo $libellePdt ?>
<br><br>

<div class ="TrocFinal">

<?php
foreach($listeprod as $produit){
	echo "<li>";
	echo '<img src="Resources/PhotosTroc/'.$produit['PHOTO_PDT'].'" width="80" />';
	echo "<br>";
	echo $produit['LIBELLE_PDT'];
	echo "<br>";
	echo "<input type='radio' class ='radioTroc' name ='radioTroc' value ='".$produit['PDT_ID']."'></input>";
	echo "</li>";
}
echo "</div>";

echo "<div class='livraison'>";
echo "Choisissez un mode de livraison parmi ceux disponibles : <br>";


foreach ($listeLivraison as $mode){
	echo "<li style='list-style:none'>";
	echo $mode['NOM_TYPE_L'];
	echo "<br>";
	echo "<input type='radio' name ='radioLivr' class = 'radioLivr' value = '".$mode['NOM_TYPE_L']."'></input>";
	echo "</li>";
	
}
echo "</div>";
?>


<div class='finaliser_troc' id='finaliser_troc'>
				<a class="btn_finalTroc" data-troc="<?php echo $idTroc ?>">
				<img src="Resources/images/troc.png" width = "175"/></a>
			</div>
