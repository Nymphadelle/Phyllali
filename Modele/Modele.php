
<?php

abstract class Modele{

	private $bdd;
	
	// Effectue la connexion à la BDD
	// Instancie et renvoie la connection
  private function getBdd() {
    if ($this->bdd == null) {
      // Création de la connexion
      $this->bdd = odbc_connect('Corail', 'admin1337', 'azerty') or die('Could not connect !');
		echo 'Connected successfully';
    }
    return $this->bdd;
  }

  // Exécute une requête SQL éventuellement paramétrée
  protected function executerRequete($sql, $params = null) {
    if ($params == null) {
      $resultat = odbc_exec($this->getBdd(),$sql);// exécution directe
    }
    else {
	//on fera plus tard les parametres
      //$resultat =  $this->getBdd()->prepare($sql);  // requête préparée
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