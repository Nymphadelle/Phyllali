
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
		$infoUtil = array(utf8_encode(odbc_result($req, 'util')), utf8_encode(odbc_result($req, 'PRENOM')),utf8_encode(odbc_result($req, 'mail')));
		return $infoUtil;
	}
	
	// obtenir les infos d'un utilisateur par l'id
	public function getUser($id) {
		$sql = "select NOM,PRENOM,ADRESSE,NOM_VILLE,CODE_POSTAL_ from UTILISATEUR INNER JOIN VILLE ON UTILISATEUR.ID_VILLE = VILLE.ID_VILLE WHERE UTIL_ID =".$id;
		$req=$this->executerRequete($sql);
		return array(odbc_result($req, 'NOM'), odbc_result($req, 'PRENOM'), odbc_result($req, 'ADRESSE'), odbc_result($req, 'NOM_VILLE'), odbc_result($req, 'CODE_POSTAL_'));
	}
	
	// mettre à jour les informations d'un utilisateur
	public function majUser($id,$nom,$prenom,$addr,$cp,$ville) {
		// on met à jour sa ville
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
		// on met à jour les infos dans la table utilisateur
		$sql = "update UTILISATEUR SET ID_VILLE=".$indiceVille.",NOM='".$nom."',PRENOM='".$prenom."',ADRESSE='".$addr."' WHERE UTIL_ID =".$id;
		$req=$this->executerRequete($sql);
	}
}?>