
<FORM method=post>
<TABLE BORDER=0>
<TR>
	<TD>Commentaire</TD>
	<TD>
	<TEXTAREA rows="4" cols="50" id="commentaire"></TEXTAREA>
	</TD>
</TR>

<TR>
	<TD>Note</TD>
	<TD>
	<SELECT id="note">
		<option value="" selected disabled>--</option> 
		<option value="0">0</option> 
		<option value="1">1</option> 
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	</SELECT>
	<INPUT type="hidden" value="<?php echo $_POST['uti']; ?>" id="idcible">
	<INPUT type="hidden" value="<?php echo $_POST['troc']; ?>" id="troc">
	</TD>
</TR>

<TR>
	<TD COLSPAN=2>
	<INPUT type="submit" value="Envoyer" id="envoyernote">
	<INPUT type="submit" value="Annuler" id="annuler">
	</TD>
</TR>
</TABLE>
</FORM>

