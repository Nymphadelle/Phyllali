<?php
session_start();
require_once '../Classes/Produit.php';
require_once '../Classes/Categorie.php';
$produit = new Produit();
$prod = $produit->getProduitParId($_GET['id']);
$_SESSION['pdtid'] = $_GET['id'];
?>
<form id="form" method=post action="./ajax/majetactivation.php" enctype="multipart/form-data">
	<TABLE BORDER=0>
		<TR>
			<TD colspan="2" align="center">
				<img src="Resources/PhotosTroc/<?php echo $prod['PHOTO_PDT']; ?>" width="150">
			</TD>
		</TR>
		<TR>
			<TD>Description</TD>
			<TD>
			<TEXTAREA rows="3" name="description" id="description"><?php echo $prod['DESCRIPTION'];?></TEXTAREA>
			</TD>
		</TR>

		<TR>
			<TD>Etat</TD>
			<TD>
			<select id="etat" name="etat">
				<option value="N" <?php if ($prod['ETAT'] == 'N') echo 'selected'; ?>>Neuf</option>
				<option value="M"<?php if ($prod['ETAT'] == 'M') echo 'selected'; ?> >Moyen</option>
				<option value="P"<?php if ($prod['ETAT'] == 'P') echo 'selected'; ?> >Passable</option>
				<option value="A"<?php if ($prod['ETAT'] == 'A') echo 'selected'; ?> >Abim&eacute;</option>
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
			<TD COLSPAN=2>
			<INPUT type="submit" value="Remettre au troc" id="valider_objet"> <!-- onclick="verif(); return false;"> -->
			</TD>
		</TR>
	</TABLE>

</form>