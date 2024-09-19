<?php
session_start();

try {
	$db = new PDO("mysql:host=localhost;dbname=codeshare", "root", "");
} catch (PDOException $e) {
	die('erreur: ' . $e->getMessage());
}
/*
UploadiFive
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
*/

// Set the uplaod directory
$uploadDir = '/codeShare/uploads/';


// Set the allowed file extensions
$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions
global $state ;

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile   = $_FILES['avatar']['tmp_name'];
	$uploadDir  = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
	$targetFile = $uploadDir . $_FILES['avatar']['name'];

	// Validate the filetype
	$fileParts = pathinfo($_FILES['avatar']['name']);
	if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

		// Save the file
		move_uploaded_file($tempFile, $targetFile);
		
		$q = $db->prepare('UPDATE users SET avatar = ? WHERE id = ?');
		$cible = "uploads/".$_FILES['avatar']['name'];
		$q->execute([$cible, $_POST['user_id']]);
		$_SESSION['avatar'] = $cible;
		echo $_POST['user_id'] . " " . $cible;
		
	} else {

		// The file type wasn't allowed
		echo 'Invalid file type.';
	}
}
