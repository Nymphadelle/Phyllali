<?php 

session_start();
require_once '../Classes/Troc.php';
require_once '../Classes/Produit.php';
$prod = new Produit();
$trocs = new Troc();
$donnees = $trocs->getHistorique($_SESSION['id']);
$tmp = array(array(),array(),array(),array(),array(),array());

foreach ($donnees as $donnee) {
	if ($donnee['HEURES'] < 24)
		array_push($tmp[0],$donnee);
	else if ($donnee['HEURES'] < 72)
		array_push($tmp[1],$donnee);
	else if ($donnee['HEURES'] < 168)
		array_push($tmp[2],$donnee);
	else if ($donnee['HEURES'] < 336)
		array_push($tmp[3],$donnee);
	else if ($donnee['HEURES'] > 336)
		array_push($tmp[4],$donnee);
	else
		array_push($tmp[5],$donnee);
}

?>

  <script>
  $(function() {
    $( "#accordion" ).accordion({
      heightStyle: "content"
    });
  });
  </script>
  <div id="accordion">
  <?php 
	for($i=0;$i<6;$i++) {
		if (count($tmp[$i]) > 0) { 
			switch ($i) {
				case (0) : echo '<h3> trocs finis il y a moins de 24h </h3>';break;
				case (1) : echo '<h3> trocs finis entre 24h et 72h </h3>';break;
				case (2) : echo '<h3> trocs finis il y a moins de 1 semaine </h3>';break;
				case (3) : echo '<h3> trocs finis entre 1 et 2 semaines </h3>';break;
				case (4) : echo '<h3> trocs finis il y a plus de 2 semaines </h3>';break;	
				default : echo '<h3> date indéterminée </h3>';break;
			}
			// pour chaque troc 
			echo '<div><table>
						<tr bgcolor="#99275a">
							<td colspan="2" align="center">
								<font color="white">Produit que vous avez obtenu</font>
							</td>
							<td colspan="2" align="center">
								<font color="white">Produit que vous avez troqu&eacute;</font>
							</td>
							<td align="center">
								<font color="white">Date</font>
							</td>
							<td align="center">
								<font color="white">Mode de livraison</font>
							</td>
						</tr>';
				$j = 0;
			foreach ($tmp[$i] as $troc) {
				$p2 = $prod->getProduitParId($troc['ID_PROD_VOULU']);
				$p1 = $prod->getProduitParId($troc['ID_PROD_PROPOSE']);
				echo '<tr > 
							<td style="border-bottom: 1px solid black;">';
								if($p1['PHOTO_PDT']!=null)
									echo '<img src="Resources/PhotosTroc/'.$p1['PHOTO_PDT'].'" width="100" />';
								else
									echo '<img src="Resources/images/no_image.jpg" width="100"/>';
				echo '		</td>
							<td style="border-bottom: 1px solid black;"> <font size="2">'.
								$p1['LIBELLE_PDT'].'<hr>'.$p1['DESCRIPTION'].
							'</font></td>
							<td style="border-bottom: 1px solid black;">';	
								if($p2['PHOTO_PDT']!=null)
									echo '<img src="Resources/PhotosTroc/'.$p2['PHOTO_PDT'].'" width="100" />';
								else
									echo '<img src="Resources/images/no_image.jpg" width="100" />';
				echo '		</td>
							<td style="border-bottom: 1px solid black;"><font size="2">'.
								$p2['LIBELLE_PDT'].'<hr>'.$p2['DESCRIPTION'].
							'</font></td style="border-bottom: 1px solid black;">';
				echo '		<td style="border-bottom: 1px solid black;"><font size="2">'.$troc['JOUR'].'/'.$troc['MOIS'].'/'.$troc['ANNEE'].'</font></td>';
				echo '		<td style="border-bottom: 1px solid black;">';
				if ($troc['MODE_LIVRAISON'] == null)
					echo '<font size="2">Non pr&eacute;cis&eacute;</font>';
				else
					echo '<font size="2">'.$troc['MODE_LIVRAISON'].'</font>';
				echo '</td>';
				if ($troc['com'] == 0) {
					echo '<td><font size="2"> <input type="button" class="noterutil" id="'.$troc['TROC_H_ID'].'" value="Mettre note"><input type="hidden"  id="uticible'.$troc['TROC_H_ID'].'" name="NumeroPage"  value="'.$troc['ID_CIBLE'].'"> </font></td>';
				}
				
				echo '</tr>';
				
				
			}
			echo '</table></div>';
		}
	}
	?>
</div>