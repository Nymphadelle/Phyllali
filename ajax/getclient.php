<?php 
	session_start();
	require_once '../Classes/Utilisateur.php';
	$user = new Utilisateur();
	$usr = $user->getUser($_SESSION['id']);?>

<FORM method=post action="#">
Modification de vos informations personnelles :
<TABLE BORDER=0>
<TR>
	<TD>Nom</TD>
	<TD>
	<INPUT type=text id="nom" value="<?php echo $usr[0];?>">
	</TD>
</TR>

<TR>
	<TD>Prenom</TD>
	<TD>
	<INPUT type=text id="prenom" value="<?php echo $usr[1];?>">
	</TD>
</TR>

<TR>
	<TD>Adresse</TD>
	<TD>
	<INPUT type=text id="addr" value="<?php echo $usr[2];?>">
	</TD>
</TR>

<TR>
	<TD>Code postal</TD>
	<TD>
	<INPUT type=text id="cp" value="<?php echo $usr[4];?>">
	</TD>
</TR>

<TR>
	<TD>Ville</TD>
	<TD>
	<INPUT type=text id="ville" value="<?php echo $usr[3];?>">
	</TD>
</TR>

<TR>
	<TD COLSPAN=2>
	<INPUT type="button" value="Envoyer" id="validerModifInfos">
	<INPUT type="submit" value="Annuler">
	</TD>
</TR>

</TABLE>
</FORM>