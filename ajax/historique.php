<?php 

session_start();
require_once '../Classes/Utilisateur.php';

$user = new Utilisateur();
$donnees = $user->getHistorique($_SESSION['id']);
?>

