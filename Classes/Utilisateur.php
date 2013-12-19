
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
		$sql = "SELECT util, mail, PRENOM, NOTE_MOYENNE FROM CONNEXION, UTILISATEUR WHERE mail ='".$mail."' AND mdp='".$mdp."' AND UTIL_ID = util";
		$req=$this->executerRequete($sql);
		$infoUtil = array(utf8_encode(odbc_result($req, 'util')), utf8_encode(odbc_result($req, 'PRENOM')),utf8_encode(odbc_result($req, 'mail')),utf8_encode(odbc_result($req, 'NOTE_MOYENNE')));
		return $infoUtil;
	}
	
	// obtenir les infos d'un utilisateur par l'id
	public function getUser($id) {
		$sql = "select NOM,PRENOM,ADRESSE,NOM_VILLE,CODE_POSTAL_ from UTILISATEUR INNER JOIN VILLE ON UTILISATEUR.ID_VILLE = VILLE.ID_VILLE WHERE UTIL_ID =".$id;
		$req=$this->executerRequete($sql);
		return array(odbc_result($req, 'NOM'), odbc_result($req, 'PRENOM'), odbc_result($req, 'ADRESSE'), odbc_result($req, 'NOM_VILLE'), odbc_result($req, 'CODE_POSTAL_'));
	}
	
	// fonction qui permet à un utilisateur de consulter le profil d'un autre utilisateur
	public function getProfil($id){
		$sql = "SELECT PRENOM, NOM_VILLE, mail FROM UTILISATEUR, VILLE, CONNEXION WHERE UTILISATEUR.UTIL_ID=".$id." AND VILLE.ID_VILLE = UTILISATEUR.ID_VILLE AND CONNEXION.util = UTILISATEUR.UTIL_ID";
		$req = $this->executerRequete($sql);
		$tableau=array();
		while($row = odbc_fetch_array($req)){
			array_push($tableau, $row);
		}
		
		return $tableau;
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
	
	//nom de l'utilisateur
	public function getName($id_util){
		$sql = "Select PRENOM from UTILISATEUR where UTIL_ID=".$id_util;
		$util = $this->executerRequete($sql);
		return odbc_result($util,'PRENOM');
	}
	
	public function getImageNote($id) {
	
		$sql = "select NOTE_MOYENNE from UTILISATEUR where UTIL_ID = ".$id;	
		$ret = $this->executerRequete($sql);
		$note = odbc_result($ret,'NOTE_MOYENNE');
	
		if ($note == '')
				return "";
			else if (round($note,2) <= 0.5)
				return '<img class="afficherprofil" id="'.$id.'" src="Resources/images/0.5.png" width="80" style>';
			else if (round($note,2) <= 1)
				return '<img class="afficherprofil" id="'.$id.'" src="Resources/images/1.png" width="80">';
			else if (round($note,2) <= 1.5)
				return '<img class="afficherprofil" id="'.$id.'" src="Resources/images/1.5.png" width="80">';
			else if (round($note,2) <= 2)
				return '<img class="afficherprofil" id="'.$id.'" src="Resources/images/2.png" width="80">';
			else if (round($note,2) <= 2.5)
				return '<img class="afficherprofil" id="'.$id.'" src="Resources/images/2.5.png" width="80">';
			else if (round($note,2) <= 3)
				return '<img class="afficherprofil" id="'.$id.'" src="Resources/images/3.png" width="80">';
			else if (round($note,2) <= 3.5)
				return '<img class="afficherprofil" id="'.$id.'" src="Resources/images/3.5.png" width="80">';
			else if (round($note,2) <= 4)
				return '<img class="afficherprofil" id="'.$id.'" src="Resources/images/4.png" width="80">';
			else if (round($note,2) <= 4.5)
				return '<img class="afficherprofil" id="'.$id.'" src="Resources/images/4.5.png" width="80">';
			else 
				return '<img class="afficherprofil" id="'.$id.'" src="Resources/images/5.png" width="80">';	
	}
	
	
	public function getNotes($id){
		$sql = "SELECT * FROM NOTE WHERE UTIL_ID = ".$id;
		$req = $this->executerRequete($sql);
		$tableau=array();
		while($row = odbc_fetch_array($req)){
			array_push($tableau, $row);
		}
		return $tableau;
	}
	
	public function getNotes2($id){
		$sql = "SELECT * FROM NOTE WHERE UTI_UTIL_ID = ".$id;
		$req = $this->executerRequete($sql);
		$tableau=array();
		while($row = odbc_fetch_array($req)){
			array_push($tableau, $row);
		}
		return $tableau;
	}
	
}?>