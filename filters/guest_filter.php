<?php

if( !empty($_SESSION['user_id']) && !empty($_SESSION['pseudo'] )){
    header('location: index.php');
    exit();
}
?>
