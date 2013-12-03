
<?php
require_once 'Connect.php';

class Utilisateur extends Connect{
	public function insertUser($nom,$prenom,$mail,$mdp,$addr,$cp,$ville){
		$sql = "SELECT ID_VILLE FROM VILLE WHERE NOM_VILLE='".strtoupper($ville)."' AND CODE_POSTAL_=".$cp."";
		$ret = $this->executerRequete($sql);
		$indiceVille = odbc_fetch_row($ret);
		// si la ville n'existe pas on insère
		if ( $indiceVille == '' ) {
			// on insère 
			$sql = "INSERT INTO VILLE(NOM_VILLE,CODE_POSTAL_) VALUES ('".strtoupper($ville)."', ".$cp.");";
			$this->executerRequete($sql);
			// obtenir le max de l'indice actuel
			$sql = "SELECT MAX(ID_VILLE) FROM VILLE";
			$ret = $this->executerRequete($sql);
			$indiceVille = odbc_fetch_row($ret);
		}
		
		// on insère l'utilisateur
		$sql = "INSERT INTO UTILISATEUR (ID_VILLE,NOM,PRENOM,ADRESSE) VALUES (".$indiceVille.",'".strtoupper($nom)."','".$prenom."','".$addr."');";
		echo $sql;
		$this->executerRequete($sql);
		$sql = "SELECT MAX(UTIL_ID) FROM UTILISATEUR";
		$ret = $this->executerRequete($sql);
		$indiceUtil = odbc_fetch_row($ret);
		
		// on insère ses identifiants de connexion
		$sql = "INSERT INTO CONNEXION (mail,mdp,util) VALUES ('".$mail."','".$mdp."',".$indiceUtil.");";
		echo $sql;
		$this->executerRequete($sql);

	}
		
}?>