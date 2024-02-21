<?php
session_start();
require_once '../config.php';

require_once '../models/enterprise.php';

var_dump($_SESSION);

// on recherhce la variable ('VALIDATE', 'UNVALIDATE' name de l'input)
// securité du site : on verifie que l'entreprise soit bien connecter ($_SESSION['enterprise']) pour eviter de faire une 
// modification directe au niveau de l'url.
if ((isset($_GET['validate'])) && isset($_SESSION['enterprise'])) {
    $userInfos = json_decode(Enterprise::DisplayUser($_GET['validate']), true)['data'];
    var_dump($userInfos);

    // si le user appartient a l'entreprise 
    if ($_SESSION['enterprise_id'] === $userInfos['enterprise_id']) {

        Enterprise::validate($_GET['validate']);
    }
}


if ((isset($_GET['unvalidate'])) && isset($_SESSION['enterprise'])) {
    $userInfos = json_decode(Enterprise::DisplayUser($_GET['unvalidate']), true)['data'];
    var_dump($userInfos);


    if ($_SESSION['enterprise_id'] === $userInfos['enterprise_id']) {

        Enterprise::unvalidate($_GET['unvalidate']);
    }
}
