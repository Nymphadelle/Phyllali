
<?php

abstract class Modele{

	private $bdd;
	
	// Effectue la connexion � la BDD
	// Instancie et renvoie la connection
  private function getBdd() {
    if ($this->bdd == null) {
      // Cr�ation de la connexion
      $this->bdd = odbc_connect('Corail', 'admin1337', 'azerty') or die('Could not connect !');
		echo 'Connected successfully';
    }
    return $this->bdd;
  }

  // Ex�cute une requ�te SQL �ventuellement param�tr�e
  protected function executerRequete($sql, $params = null) {
    if ($params == null) {
      $resultat = odbc_exec($this->getBdd(),$sql);// ex�cution directe
    }
    else {
	//on fera plus tard les parametres
      //$resultat =  $this->getBdd()->prepare($sql);  // requ�te pr�par�e
     // $resultat->execute($params);
    }
    return $resultat;
  }

	//test
	function closeBdd(){
		odbc_close($conn);
	}
}
?>