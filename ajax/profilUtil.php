<?php 

session_start();
require_once '../Classes/Utilisateur.php';
$id_proprio = $_POST['id_proprio'];

$utilisateur = new Utilisateur;
$tableauProfil = $utilisateur->getProfil($id_proprio);


echo "<div id = 'infos'>";
echo "Prénom : ".$tableauProfil[0]['PRENOM']."<br>";
echo "Ville : ".$tableauProfil[0]['NOM_VILLE']."<br>";
echo "Note : <br>";
echo "<a href='mailto:".$tableauProfil[0]['mail']."'>Contacter cet utilisateur</a><br>";
echo "</div>";

