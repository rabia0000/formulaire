<?php
session_start();

// var_dump($_SESSION);

// var_dump($_SESSION); /// pour check si c good :)
//config
require_once '../config.php';
// models
include_once '../models/enterprise.php';

//Appeler la fonction pour récupérer les utilisateurs
$utilisateur_json = Enterprise::countUser($_SESSION['enterprise']['enterprise_id']);
$utilisateur = json_decode($utilisateur_json, true);
$nbTotalUtilisateur = $utilisateur['data']['user_count'] ?? 9;

//utilisateur actif
$utilisateurActif_json = Enterprise::countActifUser($_SESSION['enterprise']['enterprise_id']);

$utilisateurActif = json_decode($utilisateurActif_json, true);
// var_dump($utilisateurActif);
$nbTotalUtilisateurActif = $utilisateurActif['data']['user_count'] ?? 0;


//total ride : 

$totalRide_json = Enterprise::countTotalRide($_SESSION['enterprise']['enterprise_id']);
$totalRide = json_decode($totalRide_json, true);

$nbTotalRide = $totalRide['data'] ?? 0;


// affichage des 5 derniers utlisateurs

$displayUser_json = Enterprise::displayLastUser($_SESSION['enterprise']['enterprise_id']);
$displayUser = json_decode($displayUser_json, true);

$displayUsertotal = $displayUser['data'] ?? 8;

// total des 5 derniers trajets 


$displayLastrides = Enterprise::displayLastFiveRides($_SESSION['enterprise']['enterprise_id']);
$displayRides = json_decode($displayLastrides, true);
// var_dump($displayRides);
$displaytotalride = $displayRides['data'] ?? 0;




if (!$_SESSION['enterprise']) {
    header('Location: controller-signin.php');
}
// retourne le résultat du json si c'est true
// $lastfiveusers = json_decode(Enterprise::displayLastUser($_SESSION['enterprise']['enterprise_id']), true);
// $lastFiveRide = json_decode(Enterprise::displayLastFiveRides($_SESSION['enterprise']['enterprise_id']), true);



// var_dump($lastfiveusers);
// Contrôleur - Gestion de la logique métier

// Vérifications et traitements du formulaire ici

// Inclusion de la vue

include_once('../views/view-home.php');
