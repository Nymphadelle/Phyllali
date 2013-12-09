<?php
require_once '../Classes/Categorie.php';
?>
<form method=post action="#">
	<TABLE BORDER=0>
		<TR>
			<TD>Nom</TD><!-- libellé -->
			<TD>
			<INPUT type=text id="libelle">
			</TD>
		</TR>

		<TR>
			<TD>Cat&eacute;gorie</TD><!-- catégorie -->
			<TD>
				<select id="cat">
				<?php
				$cat = new Categorie;
				
				//on affiche chaque catégorie
				$tab_cat = array();
				$tab_cat = $cat->getCategories();
				
				foreach($tab_cat as $row){
					echo '<option id="'.$row['ID_CATEGORIE'].'">'.$row['NOM_CATEG'].'</option>';
					
					//on affiche les sous catégories directement sous leur catégorie
					$tab_scat = array();
					$tab_scat = $cat->getSousCategories($row['ID_CATEGORIE']);
					
					foreach($tab_scat as $row){
						echo '<option value="'.$row['ID_CATEGORIE'].'"> - '.$row['NOM_CATEG'].'</option>';;
					}
				}
				?>
				</select>
			</TD>
		</TR>

		<TR>
			<TD>Description</TD>
			<TD>
			<INPUT type=text id="description">
			</TD>
		</TR>

		<TR>
			<TD>Etat</TD>
			<TD>
			<INPUT type=text id="etat">
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
			<INPUT type=file id="photo">
			</TD>
		</TR>

		<TR>
			<TD COLSPAN=2>
			<INPUT type="button" value="Ajouter l'objet" id="valider_objet">
			</TD>
		</TR>
	</TABLE>

</form>