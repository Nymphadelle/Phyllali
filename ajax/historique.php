<?php 

session_start();
require_once '../Classes/Troc.php';
require_once '../Classes/Produit.php';
$prod = new Produit();
$trocs = new Troc();
$donnees = $trocs->getHistoriqueEmetteur($_SESSION['id']);
$donnees2 = $trocs->getHistoriqueCible($_SESSION['id']);
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
print_r($donnees);
?>

<script>
  $(function() {
    $( "#accordion" ).accordion();
  });
  
  </script>
  <div id="accordion">
  <?php 
	for($i=0;$i<6;$i++) {
		if (count($tmp[$i]) > 0) { 
			switch ($i) {
				case (0) : echo '<h3> trocs fini il y a moins de 24h </h3>';break;
				case (1) : echo '<h3> trocs fini entre 24h et 72h </h3>';break;
				case (2) : echo '<h3> trocs fini il y a moins de 1 semaine </h3>';break;
				case (3) : echo '<h3> trocs fini entre 1 et 2 semaines </h3>';break;
				case (4) : echo '<h3> trocs fini il y a plus de 2 semaines </h3>';break;	
				default : echo '<h3> date indéterminée </h3>';break;
			}
			// pour chaque troc 
			echo '<div><table border="1">
						<tr>
							<td colspan="2">
								Produit que vous avez obtenu
							</td>
							<td colspan="2">
								Produit que vous avez troqué
							</td>
							<td>
								Date
							</td>
							<td>
								Mode de livraison
							</td>
						</tr>';
			foreach ($tmp[$i] as $troc) {
				$p1 = $prod->getProduitParId($troc['ID_PROD_VOULU']);
				$p2 = $prod->getProduitParId($troc['ID_PROD_PROPOSE']);
				echo '<tr>
							<td>';
								if($p1['PHOTO_PDT']!=null)
									echo '<img src="Resources/PhotosTroc/'.$p1['PHOTO_PDT'].'" width="100" />';
								else
									echo '<img src="Resources/images/no_image.jpg" width="100"/>';
				echo '		</td>
							<td>'.
								$p1['LIBELLE_PDT'].'<br><br>'.$p1['DESCRIPTION'].
							'</td>
							<td>';	
								if($p2['PHOTO_PDT']!=null)
									echo '<img src="Resources/PhotosTroc/'.$p2['PHOTO_PDT'].'" width="100" />';
								else
									echo '<img src="Resources/images/no_image.jpg" width="100" />';
				echo '		</td>
							<td>'.
								$p2['LIBELLE_PDT'].'<br><br>'.$p2['DESCRIPTION'].
							'</td>';
				echo '		<td>'.$troc['DATE_TRANSACTION'].'</td>';
				echo '		<td>'.$troc['MODE_LIVRAISON'].'</td>';
				
						

			echo '</table></div>';
			}
		}
	}
	?>
</div>