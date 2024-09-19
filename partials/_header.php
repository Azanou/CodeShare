<?php include('includes/constants.php') ?>

<!doctype html>
<html lang="fr" class="h-100" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>
        <?php 
        echo isset($title) ? $title." | ".WEBSITE_NAME : WEBSITE_NAME." "."-simple, rapide , efficace !";
        ?>
    </title>
    
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/main.css">
    <link rel="stylesheet" href="assets/highlight/styles/atom-one-dark.min.css">
    <link rel="stylesheet" href="libraries/uploadifive/uploadifive.css">
    <link rel="stylesheet" href="libraries/alertify/alertify.css">
    <link rel="stylesheet" href="libraries/node_modules/sweetalert2/dist/sweetalert2.min.css">
    
</head>

<body class="h-100 text-center text-bg-dark">

    <div class=" d-flex w-100 h-100 p-3 flex-column">
        <?php include('partials/_nav.php')?>
        <p></p>
        <?php include('partials/_flash.php')?>


        
        
       