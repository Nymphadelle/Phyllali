
<?php
require_once 'Classes/Produit.php';
require_once 'Classes/Categorie.php';
session_start();
$donnees = new Categorie();
$categories = $donnees->getCategories();

$donnees = new Produit();
$produits = $donnees->getProduits();
?>
<!doctype html>
<html>
	<head>
		<link href="Resources/style.css" type="text/css" media="screen" rel="stylesheet">
		<script type="text/javascript" src="Resources/jquery-1.8.2.min.js"></script>
	</head>
<body>
	<div class="connectUtilisateur">
		<div id="titre">
			<img src="resources/images/titre.png" alt="" />
		</div>
		<div id = "recherche">
			<input type="text" value="Recherche" size="50px">
		</div>
		<div id="compte">
		<?php
		if(isset($_SESSION['id']) && $_SESSION['id'] != ''){
			echo "Bonjour ".$_SESSION['prenom'];
			echo "</div>";
			echo "<div id='buttons'>";
			echo "<form method='POST' action ='#'><input type='submit' id='ajouter' value='+'></form><br>";
			echo "<form method='POST' action ='ajax/decoclient.php'><input type='submit' id='deconnexion' value='D�connexion'></form>";
			echo "</div>";
		}
		else{
			echo 'Identifiant : <input type="text" value="pseudo.." id="email" >';
			echo 'Mot de passe : <input type="text" value="******" id="mdp" >';
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
	<h1> Troc en ligne</h1>
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </br>
	Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
	produits...</br>

	<?php 

	foreach($produits as $produit){

	echo "Nom du produit : ".$produit['LIBELLE_PDT']."</br>";


	}
	?>
	</div>

	
	</div>
	</body>
</html>
<script type="text/javascript" src="Resources/javascript.js?v=<?php echo rand();?>"></script>