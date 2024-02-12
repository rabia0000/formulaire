<?php

require_once '../config.php';
require_once '../models/enterprise.php';
// var_dump($_POST);
$showform = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // je créer un tableau d'erreur vide 
    $errors = [];

    if (empty($_POST["name"])) {
        //arrayname["key"]= "value";
        $errors['name'] = "Nom de l'entreprise obligatoire.";
    } else if (!preg_match("/^[a-zA-ZÀ-ÿ\-]+$/", $_POST["name"])) {
        $errors['name'] = "Le nom est invalide.";
    } else if (Enterprise::checkNameExits($_POST['name'])) {
        $errors['name'] = 'Le nom est déjà utilisé';
    }

    // Vérification de l'email
    if (empty($_POST["email"])) {
        $errors['email'] = "Email obligatoire.";
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'adresse email est invalide.";
    } else if (Enterprise::checkMailExists($_POST['email'])) {
        $errors['email'] = 'Email déjà utilisé';
    }
    // Vérification dU SIRET 
    if (empty($_POST["siret"])) {
        $errors['siret'] = "Numero de siret obligatoire";
    } else if (!preg_match('/^\d{14}$/', $_POST['siret'])) {
        $errors['siret'] = "Le numéro de SIRET doit être composé de 14 chiffres.";
    } else if (Enterprise::checkSiretExist($_POST['siret'])) {
        $errors['siret'] = 'Siret déjà utilisé';
    }

    if (empty($_POST["adress"])) {
        $errors['adress'] = "Adresse Obligatoire";
    }

    // Vérification du mot de passe
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    if (empty($password) || strlen($password) < 8 || $password !== $confirm_password) {
        $errors['password'] = "Le mot de passe doit comporter au moins 8 caractères et correspondre.";
    }

    if (empty($_POST["code"])) {
        $errors['code'] = "code postal obligatoire";
    } else if (!preg_match('/^\d{5}$/', $_POST['code'])) { {
            $errors['code'] = "Le code postal doit etre composé de 5 chiffres";
        }
    }

    if (empty($_POST["city"])) {
        $errors['city'] = "Ville Obligatoire";
    }


    // verification s'il n'y pas d'erreur, nous allons inscrire l'utilisateur
    // var_dump($errors);

    if (empty($errors)) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $siret = $_POST['siret'];
        $adress = $_POST['adress'];
        $password = $_POST['password'];
        $codePostal = $_POST['code'];
        $city = $_POST['city'];


        $photo = "default.png";


        Enterprise::create($name, $email, $siret, $adress, $password, $codePostal, $city, $photo);
        $showform = false;
    }
}



?>












<?php
// Contrôleur - Gestion de la logique métier

// Vérifications et traitements du formulaire ici

// Inclusion de la vue

include_once('../views/view-signup.php');


?>
