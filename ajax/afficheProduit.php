<?php 

session_start();
require_once '../Classes/Produit.php';
require_once '../Classes/Utilisateur.php';

$id_pdt = $_GET['id_pdt'];

$donnee = new Produit();
$user = new Utilisateur();

$produit = $donnee->getProduitParId($id_pdt);
$tmp = $user->getImageNote($produit['UTIL_ID']);
?>
<script type="text/javascript" src="Resources/javascript.js?v=<?php echo rand();?>"></script>

<div class="Produit">
<h2> <?php echo "<a class='pdt' id= ".$produit['PDT_ID']." >".$produit['LIBELLE_PDT']."</a>"   ?> </h2>

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
			
			
			echo 'Propri&eacute;taire : <a class="proprietaire" id="'.$produit['UTIL_ID'].'">'.$produit['mail'].'</a> '.$tmp.'</br>';
			echo 'Categorie : <a class="cat" id="'.$produit['ID_CATEGORIE'].'">'.$produit['NOM_CATEG'].'</a></br></br>';
			echo "Description : ".$produit['DESCRIPTION'];
			echo "</br>Etat : ".$produit['ETAT'];
			echo "</br></br>Date limite du troc : ".$produit['DATE_FIN']."</br></br>";
		
		
		if(isset($_SESSION['id']) && $_SESSION['id'] != '' && $_SESSION['id']!=$produit['UTIL_ID']){
			echo "</div>";
			echo "<div class='souhaiter' id='souhaiter' >";
			
			?>
			<a><img src="Resources/images/souhait.png" width="175" /></a>
			<?php
			echo "</div>";
		}
		else if(isset($_SESSION['id']) && $_SESSION['id'] != '' && $_SESSION['id']==$produit['UTIL_ID']){
			echo '</div>';
			echo '<div>';
			echo 'Vous ne pouvez pas faire de souhait car ce produit vous appartient</div>';
		}else{
		
			echo '</div>';
			echo '<div>';
			echo 'Se connecter pour faire un souhait</div>';
		}
		
	
		?>
		</div>
</div>