<?php
require_once '../Classes/IA.php';
require_once '../Classes/Produit.php';
$niv = 0;

// fonction de tronquage
function truncate($string, $max_length = 30, $replacement = '', $trunc_at_space = false)
{
	$max_length -= strlen($replacement);
	$string_length = strlen($string);	
	if($string_length <= $max_length)
		return $string;
	if( $trunc_at_space && ($space_position = strrpos($string, ' ', $max_length-$string_length)) )
		$max_length = $space_position;	
	return substr_replace($string, $replacement, $max_length);
}
$prod = new Produit();
$poids = $prod->getPoids();
// si on a un nombre impair de produits
if (sizeof($poids) %2 != 0)
	array_pop($poids);

	$array = array();

$hash = array();	
// on renseigne le tableau de valeurs pour créer les combinaisons
foreach ($poids as $val) {
	$hash[$val['lettre']] = $val['PDT_ID'];
	$tmp = array($val['lettre'],$val['POIDS_APPAIRAGE']);
	array_push($array,$tmp);
}




$array2 = array();
$array3 = array();
for ($i=0;$i<sizeof($array);$i++)
	for ($j=$i+1;$j<sizeof($array);$j++){
		if ($array[$i][1] < $array[$j][1])
			$ratio = $array[$i][1]/$array[$j][1];
		else
			$ratio = $array[$j][1]/$array[$i][1];
		if ($i == 0)
			array_push($array3,array($array[$i][0].''.$array[$j][0],(truncate($ratio,3))));
		array_push($array2,array($array[$i][0].''.$array[$j][0],(truncate($ratio,3))));
	}

// état initiale, aucunes paires n'est crée
$etatInit = 0;
// état final, toutes les paires sont crées
$etatFinal = sizeof($array)/2;
$tpb = new Pb($etatInit,$etatFinal);
$actions = new Action($array2);
$chemin = new Chemin($tpb->etatIni,array());

$a = array();
array_push($a,$chemin);
$trouve = false;
$solution;
while(!$trouve && sizeof($a) != 0) {
	$t = array_shift($a);
	// si on est au but
	if ($t->etat == $tpb->etatFinal) {
		$max = 0;
		$i = 0;
		for($i=0;$i<sizeof($a);$i++) {
			if ($a[$i]->coutTotal > $max) {
				$max = $a[$i]->coutTotal;
				$indice = $i;
			}
		}
		if ($a[$indice]->coutTotal > $t->coutTotal)
			$solution = $a[$indice];
		else
			$solution = $t;
		$trouve = true;
	}
	// sinon
	else {
		if ($t->etat == 0) {
			$actions = new Action($array3);
		}
		else
			$actions = new Action($array2);
			

		foreach($actions->actions as $action){
			// calcul du successeur
			$n = $tpb->successeur($t->etat,$action);
			// creation de son chemin
			$ch = new Chemin($n->etat,$t->sol);
			array_push($ch->sol,$n);
			$ch->coutTotal = $t->coutTotal;
			$niv = $ch->etat;

			// vérifier si cette combinaison est possible
			if ($tpb->verifier($ch) === true) {
				$ch->coutTotal += $n->action[1];
				array_push($a,$ch);
			}
		}
	}
}

$couples = array();
$prod->deleteCouples();
foreach($solution->sol as $couple) {
	$prod->insertCouple($hash[substr($couple->action[0],0,1)],$hash[substr($couple->action[0],1,1)]);
}


?>