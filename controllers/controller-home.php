


<?php
session_start();
// var_dump($_SESSION);

// var_dump($_SESSION); /// pour check si c good :)
//config
require_once '../config.php';
// models
include_once '../models/enterprise.php';

// toute ta logique 

if (!$_SESSION['enterprise']) {
    header('Location: controller-signin.php');
}
$lastfiveusers = Enterprise::displayLastUser($_SESSION['enterprise']['enterprise_id']);



var_dump($lastfiveusers);
// Contrôleur - Gestion de la logique métier

// Vérifications et traitements du formulaire ici

// Inclusion de la vue

include_once('../views/view-home.php');
