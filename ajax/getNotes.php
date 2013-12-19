<?php 
session_start();
require_once '../Classes/Utilisateur.php';
$user = new Utilisateur();
$notes = $user->getNotes($_POST['id']);
$notes2 = $user->getNotes2($_POST['id']);
?>

  <script>
  $(function() {
    $( "#accordion" ).accordion({
      heightStyle: "content"
    });
  });
  </script>
  <div id="accordion">
  <h3>Les notes re&ccedil;ues</h3>
  <div>
  <table>
	<tr bgcolor="#99275a">
		<td align="center">
			<font color="white">Note</font>
		</td>
		<td align="center">
			<font color="white">Utilisateur</font>
		</td>
		<td align="center">
			<font color="white">Commentaire</font>
		</td>
		<td align="center">
			<font color="white">Date</font>
		</td>	
	</tr>
  <?php 
  foreach($notes as $note) {
	$tmp = $user->getUser($note['UTI_UTIL_ID']);
	echo '<tr>
			<td>'.round($note['NOTE'],2).'/5</td>
			<td>'.$tmp[1].'</td>
			<td>'.$note['COMMENTAIRE'].'</td>
			<td>'.$note['DATE'].'</td>
		</tr>';
  }

  ?>
  </table>
  </div>
  <h3>Les notes envoy&eacute;es</h3>
  <div>
  <table>
	<tr bgcolor="#99275a">
		<td align="center">
			<font color="white">Note</font>
		</td>
		<td align="center">
			<font color="white">Utilisateur</font>
		</td>
		<td align="center">
			<font color="white">Commentaire</font>
		</td>
		<td align="center">
			<font color="white">Date
		</td>
	</tr>
  <?php 
  foreach($notes2 as $note) {
  	$tmp = $user->getUser($note['UTIL_ID']);
	echo '<tr>
			<td>'.round($note['NOTE'],2).'/5</td>
			<td>'.$tmp[1].'</td>
			<td>'.$note['COMMENTAIRE'].'</td>
			<td>'.$note['DATE'].'</td>
		</tr>';
  }

  ?>
  </div>
  </table>
</div>