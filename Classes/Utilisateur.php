
<?php
require_once 'Connect.php';

class Utilisateur extends Connect{
	public function insertUser($nom,$prenom,$mail,$mdp,$addr,$cp,$ville){
		$sql = "SELECT ID_VILLE FROM VILLE WHERE NOM_VILLE='".strtoupper($ville)."' AND CODE_POSTAL_=".$cp."";
		$ret = $this->executerRequete($sql);
		$indiceVille = odbc_result($ret,'ID_VILLE');
		
		// si la ville n'existe pas on insère
		if ( $indiceVille == '' ) {
			// on insère 
			$sql = "INSERT INTO VILLE(NOM_VILLE,CODE_POSTAL_) VALUES ('".strtoupper($ville)."', ".$cp.");";
			$this->executerRequete($sql);
			// obtenir le max de l'indice actuel
			$sql = "SELECT MAX(ID_VILLE) as ID FROM VILLE";
			$ret = $this->executerRequete($sql);
			$indiceVille = odbc_result($ret,'ID');
		}
		
		// on insère l'utilisateur
		$sql = "INSERT INTO UTILISATEUR (ID_VILLE,NOM,PRENOM,ADRESSE) VALUES (".$indiceVille.",'".strtoupper($nom)."','".$prenom."','".$addr."');";
		$this->executerRequete($sql);
		$sql = "SELECT MAX(UTIL_ID) as ID FROM UTILISATEUR";
		$ret = $this->executerRequete($sql);
		$indiceUtil = odbc_result($ret,'ID');
		
		// on insère ses identifiants de connexion
		$sql = "INSERT INTO CONNEXION (mail,mdp,util) VALUES ('".$mail."','".$mdp."',".$indiceUtil.");";
		$this->executerRequete($sql);
	}
	
	public function connectionUser($mail, $mdp){
		$sql = "SELECT util, mail, PRENOM FROM CONNEXION, UTILISATEUR WHERE mail ='".$mail."' AND mdp='".$mdp."' AND UTIL_ID = util";
		$req=$this->executerRequete($sql);
		$infoUtil = array(odbc_result($req, 'util'), odbc_result($req, 'PRENOM'), odbc_result($req, 'mail'));
		return $infoUtil;
	}
	
	//nom de l'utilisateur
	public function getName($id_util){
		$sql = "Select PRENOM from UTILISATEUR where UTIL_ID=".$id_util;
		$util = $this->executerRequete($sql);
		return odbc_result($util,'PRENOM');
	}
	
}?>