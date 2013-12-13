
<?php
require_once 'Classes/Produit.php';
require_once 'Classes/Categorie.php';
session_start();

$donnees = new Categorie();
$categories = $donnees->getCategories();

$donnees = new Produit();

?>
<!doctype html>
<html>
	<head>
		<link href="Resources/style.css" type="text/css" media="screen" rel="stylesheet">
		<script type="text/javascript" src="Resources/jquery-1.8.2.min.js"></script>
		  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	</head>
<body>
	<div class="connectUtilisateur">
		<div id="titre">
			<img src="resources/images/titre.png" alt="" />
		</div>
		<div id = "recherche">
			<input type="text" value="Recherche" size="40px">
		</div>
		<div id="compte">
		<?php
		if(isset($_SESSION['id']) && $_SESSION['id'] != ''){
			echo "Bonjour, ".$_SESSION['prenom'];
			echo "</div>";
			echo "<div id='picto'>";
			echo "<a id='modpro' title='Modifier profil'><img src='Resources/images/prof.png' width='30'></a>";
			echo "<a id='ajouter' title='Ajouter produit'><img src='Resources/images/add.png' width='30'></a>";
			echo "<a id='listeSouhaits' title='Liste de souhaits'><img src='Resources/images/souh.png' width='30'></a>";
			echo "<a id='historique' title='Historique'>H</a>";
			echo "</div>";
			echo "<div id='buttons'>";
			echo "<form method='POST' action ='ajax/decoclient.php'><input type='submit' id='deconnexion' value='Déconnexion'></form>";
			echo "</div>";

		}
		else{
			echo 'Mail : <input type="text" id="email" >';
			echo 'Mot de passe : <input type="password" id="mdp" >';
			echo '</div>';
			echo '<div id="buttons">';
			echo '<button type="button" id="connexion">Connexion</button>';
			echo '<button type="button" id="enregistrer">S\'enregistrer</button>';
			echo '</div>';
		}
		?>
		
	</div>
  
  
	<div class="content">
		<div class="bandeau">
		</div>

	<div id = "navigation_menu">
		<ul>
		<?php 
		foreach($categories as $categorie){
			echo '<li> <a class="cat" id="'.$categorie['ID_CATEGORIE'].'"><img src="Resources/nav/'.$categorie['NOM_CATEG'].'.png" />'.$categorie['NOM_CATEG'].'</a></li>';}
		?>
		</ul>
	</div>



	<div id="presentation">
	
	<?php
		// si authentifié
		if(isset($_SESSION['id']) && $_SESSION['id'] != '') {
			$paires = $donnees->getPaires($_SESSION['id']);
			if (count($paires) > 0) {
				if (count($paires) == 1) {
					echo '<div class="Aff_Produits"><h2> Nous avons peut être un échange à vous proposer ! </h2>';
						$pdt1 = $donnees->getProduitParId($paires[0]['yours']);
						$pdt2 = $donnees->getProduitParId($paires[0]['his']);
						echo 'seriez vous interessé par <b>'.$pdt2['LIBELLE_PDT'].'</b> en échange de votre <b>'.$pdt1['LIBELLE_PDT'].'</b> ?<br><br>';
						echo '<div class="vignette" id='.$pdt2["PDT_ID"].'>';
						if($pdt2['PHOTO_PDT']!=null){
						echo '<img src="Resources/PhotosTroc/'.$pdt2['PHOTO_PDT'].'" width="125" />';
						}else{
						echo '<img src="Resources/images/no_image.jpg" />';
						}
						echo $pdt2['LIBELLE_PDT']."</br>";
						echo '</div></div>';
							}
						else {
							echo '<h2> Ne seriez vous pas interessé par ces echanges ? </h2>';
						}
			}
			else {
				$produits = $donnees->getLastProduits($_SESSION['id']);
				if (count($produits) == 0)
					echo 'Aucun produits à afficher.';
				else {
					echo '<div class="Aff_Produits"><h2> Derniers produits ajoutés qui pourraient vous intéresser </h2>';
					foreach($produits as $produit){
					echo '<div class="vignette" id='.$produit["PDT_ID"].'>';
					if($produit['PHOTO_PDT']!=null){
					echo '<img src="Resources/PhotosTroc/'.$produit['PHOTO_PDT'].'" width="125" />';
					}else{
					echo '<img src="Resources/images/no_image.jpg" />';
					}
					echo $produit['LIBELLE_PDT']."</br>";
					echo '</div>';
				}
			}
			echo '</div>';
			}
		}
		// si pas authentifié
		else {
			$produits = $donnees->getLastProduits();
			if (count($produits) == 0)
					echo 'Aucun produits à afficher.';
			else {
				echo '<div class="Aff_Produits"><h2> Derniers produits ajoutés qui pourraient vous intéresser </h2>';
				foreach($produits as $produit){
					echo '<div class="vignette" id='.$produit["PDT_ID"].'>';
					if($produit['PHOTO_PDT']!=null){
					echo '<img src="Resources/PhotosTroc/'.$produit['PHOTO_PDT'].'" width="125" />';
					}else{
					echo '<img src="Resources/images/no_image.jpg" />';
					}
					echo $produit['LIBELLE_PDT']."</br>";
					echo '</div>';
				}
				echo '</div>';
			}
		}
	?>
			

	
	</div>

	
	</div>
	</body>
</html>
<script type="text/javascript" src="Resources/javascript.js?v=<?php echo rand();?>"></script>