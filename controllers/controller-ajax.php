<?php

require_once '../config.php';

require_once '../models/enterprise.php';

// on recherhce la variable (validate name de l'input)
if (isset($_GET['validate'])) {

    Enterprise::validate($_GET['validate']);
    header('Location: controller-users.php');
}


if (isset($_GET['unvalidate'])) {

    Enterprise::unvalidate($_GET['unvalidate']);
    header('Location: controller-users.php');
}
