<?php
session_start();
require_once '../Classes/Categorie.php';
require_once '../Classes/Produit.php';
?>
<form id="form" method=post action="./ajax/insererproduit.php" enctype="multipart/form-data">
	<TABLE BORDER=0>
		<TR>
			<TD>Nom</TD><!-- libellé -->
			<TD>
			<INPUT type=text name="libelle" id="libelle">
			</TD>
		</TR>

		<TR>
			<TD>Cat&eacute;gorie</TD><!-- catégorie -->
			<TD>
				<select id="cat" name="cat">
				<?php
				$cat = new Categorie;
				
				//on affiche chaque catégorie
				$tab_cat = array();
				$tab_cat = $cat->getCategories();
				echo '<option value=""></option>';
				foreach($tab_cat as $row){
					echo '<OPTGROUP label="'.$row['NOM_CATEG'].'" >';
					
					//on affiche les sous catégories directement sous leur catégorie
					$tab_scat = array();
					$tab_scat = $cat->getSousCategories($row['ID_CATEGORIE']);
					
					foreach($tab_scat as $row){
						echo '<option value="'.$row['ID_CATEGORIE'].'"> - '.$row['NOM_CATEG'].'</option>';;
					}
					
					echo '</optgroup>';
				}
				?>
				</select>
			</TD>
		</TR>

		<TR>
			<TD>Description</TD>
			<TD>
			<INPUT type=text name="description" id="description">
			</TD>
		</TR>

		<TR>
			<TD>Etat</TD>
			<TD>
			<select id="etat" name="etat">
				<option value="N">Neuf</option>
				<option value="M">Moyen</option>
				<option value="P">Passable</option>
				<option value="A">Abimé</option>
			</select>
			</TD>
		</TR>

		<TR>
			<TD>Choix d&eacute;lai d'activit&eacute;</TD>
			<TD>
			<INPUT type=radio id="delai12" name="delai" value="12" checked><label>12 heures</label>
			<INPUT type=radio id="delai24" name="delai" value="24"><label>24 heures</label>
			<INPUT type=radio id="delai48" name="delai" value="48"><label>48 heures</label>
			</TD>
		</TR>
		
		<TR>
			<TD>Photo</TD>
			<TD>
			<INPUT type=file name="photo" id="photo">
			</TD>
		</TR>

		<TR>
			<TD COLSPAN=2>
			<INPUT type="submit" value="Ajouter l'objet" id="valider_objet">
			</TD>
		</TR>
	</TABLE>

</form>

<?php 
	$produits = new Produit();
	$prods = $produits->getArchive($_SESSION['id']);
	if (count($prods)>0) {

?>

<p id="feedback">
<h2> Vous possédez ces produits, mais il sont inactifs, voulez vous en remettre au troc ?  </h2>
</p>
 

  

<?php
		foreach($prods as $produit){
			?>
			<div class="vignettearchive" id=<?php echo $produit['PDT_ID']?>>
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


<?php } ?>
