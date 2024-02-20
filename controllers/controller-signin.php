<?php
session_start();
// var_dump($_SESSION);


require_once '../config.php';
require_once '../models/enterprise.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Vérification du mot de passe


    if (empty($_POST["password"]) || strlen($_POST["password"]) < 8) {
        $errors['password'] = "Le mot de passe doit comporter au moins 8 caractères";
    }

    if (empty($_POST["email"])) {
        $errors['email'] = "Champs obligatoire.";
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'adresse email est invalide.";
    }
    if (empty($errors)) {

        if (!Enterprise::checkMailExists($_POST['email'])) {
            $errors['email'] = "utilisateur inconnu";
        } else {
            var_dump(Enterprise::getInfos($_POST['email']));
            //je recupère toutes les infos via la méthode getInfos()
            $utilisateurInfos = json_decode(Enterprise::getInfos($_POST['email']), true)['data'];
            // Utilisation de password_verify pour le mdp
            if (password_verify($_POST["password"], $utilisateurInfos['enterprise_password'])) {
                //ajout de la super global $_SESSION
                $_SESSION['enterprise'] = $utilisateurInfos;

                header('Location: controller-home.php');
            } else {
                $errors['connexion'] = 'Mauvais mots de passe';
            }
        }
    }
}
?>


<?php
include_once('../views/view-signin.php');
?>