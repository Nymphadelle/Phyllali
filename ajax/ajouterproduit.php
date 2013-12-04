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
			<TD>Cat&ecute;gorie</TD><!-- catégorie -->
			<TD>
				<select name="select">
				<?php
				$cat = new Categorie;
				$tab_cat = array();
				$tab_cat = $cat->getCategories();
				foreach($tab_cat as $row){
					//print_r($row);
					echo '<option value="'.$row['ID_CATEGORIE'].'">'.$row['NOM_CATEG'].'</option>';
					
					$tab_scat = array();
					$tab_scat = $cat->getSousCategories($row['ID_CATEGORIE']);
					foreach($tab_scat as $row){
						echo '<option value="'.$row['ID_CATEGORIE'].'"> - '.$row['NOM_CATEG'].'</option>';;
					}
				}
				// <select name="select">
					// <option value="1">bangalore</option>
					// <option value="2">mumbai</option>
				// </select>
				?>
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
			<TD>Photo</TD>
			<TD>
			<INPUT type=password id="photo">
			</TD>
		</TR>

		<TR>
			<TD COLSPAN=2>
			<INPUT type="submit" value="Ajouter l'objet" id="ajouter">
			</TD>
		</TR>
	</TABLE>

</form>