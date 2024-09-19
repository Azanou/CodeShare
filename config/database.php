<?php
try{
$db = new PDO("mysql:host=localhost;dbname=codeshare","root","");
}catch(PDOException $e){
    die('erreur: '.$e->getMessage());
}
