<?php
session_start();
//suprime toute  les variables de session
session_unset();

// détruit la session
session_destroy();

//redirection vers la page de connexion
header('location:../index.php');
exit();
