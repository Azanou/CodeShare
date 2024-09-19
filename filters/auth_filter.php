<?php

if( empty($_SESSION['user_id']) || empty($_SESSION['pseudo'])){

    $_SESSION['forwarding_url'] = $_SERVER['REQUEST_URI'];

    $_SESSION['notification']['message'] = "Vous devez etre connecter pour acceder a cette page";
    $_SESSION['notification']['type'] = "danger";
    header('location: login.php');
    exit();
}
?>