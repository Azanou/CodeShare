<?php
session_start();


require('config/database.php');

//Here we'll the token of the user , because it will no longer be useful
$q = $db -> prepare('DELETE  FROM auth_tokens WHERE user_id = ?');
$q->execute([ $_SESSION['user_id'] ]);

// we'll safeguard the locale language of the user before deleting the session
$_session_keys_white_list = ['locale'];
$new_session = array_intersect_key($_SESSION, array_flip($_session_keys_white_list));
$_SESSION = $new_session;

//we destroy the cookie we won't use anymore
setcookie('auth', '', time()-3600);


//redirection to the Home page
header('Location: login.php');