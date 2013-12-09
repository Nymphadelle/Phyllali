<?php
require_once 'Connect.php';

class Pb {
	var $etatIni;
	var $etatFinal;
	function Pb($etatIni,$etatFinal) { 
		$this->etatIni = $etatIni;
		$this->etatFinal = $etatFinal;
	} 
	
	public function successeur($etat,$action) {
		return new Noeud($action,$etat+1);	
	}
	
	public function verifier($ch) {
		for ($i=0 ; $i<sizeof($ch->sol) ; $i++) {
			$p1 = substr($ch->sol[$i]->action[0],0,1);		
			$p2 = substr($ch->sol[$i]->action[0],1,1);				
			for ($j=$i+1 ; $j<sizeof($ch->sol) ; $j++) {	
				if (strpos($ch->sol[$j]->action[0],$p1) !== false || strpos($ch->sol[$j]->action[0],$p2) !== false)
					return false;
			}
		}
		return true;
	}
}


class Action {
	var $actions;
	function Action($actions) { 
		$this->actions = $actions;
	} 
}
class Noeud {
	var $action;
	var $etat;
	public function Noeud($act,$etat) {
		$this->action = $act;
		$this->etat = $etat;
	}	
	
	
	public function setActEtat($act,$etat) {
		$this->action = $act;
		$this->etat = $etat;
	}
}

class Chemin {
	var $etat;
	var $sol;
	var $coutTotal;
	function Chemin($letat,$sol) { 
		$this->etat = $letat;
		$this->sol = $sol;
		$this->coutTotal = 0;
	} 
}

class IA extends Connect{

public function recherche() {

}
	
	
}