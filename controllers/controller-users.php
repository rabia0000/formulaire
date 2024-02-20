<?php
session_start();

if (!isset($_SESSION['enterprise'])) {
    header("Location: controller-signup.php");
    exit();
}




require_once '../config.php';
// models
include_once '../models/enterprise.php';


//je modifie : 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['validate_id'])) {
        Enterprise::validate($_POST['validate_id']);
    }

    if (isset($_POST['unvalidate_id'])) {
        Enterprise::unvalidate($_POST['unvalidate_id']);
    }
}



// j'affiche : 
$display_json = Enterprise::totalUser($_SESSION['enterprise']['enterprise_id']);



$displayUsers = json_decode($display_json, true);

$displayUsertotale = $displayUsers['data'] ?? 0;

var_dump($_POST);















include('../views/view-users.php');
