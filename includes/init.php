<?php

require('bootstrap/locale.php');
require('config/database.php');
require('includes/functions.php');

// if(!empty($_COOKIE['pseudo']) && !empty($_COOKIE['user_id']) ){
//     $_SESSION['pseudo'] = $_COOKIE['pseudo'];
//     $_SESSION['user_id'] = $_COOKIE['user_id'];
//     $_SESSION['avatar'] = $_COOKIE['avatar'];
// }

auto_login();

//recovering all the notifications of the user that's actually connected !!!

$q = $db->prepare("SELECT * FROM notifications WHERE subject_id = ? AND seen='0' ");
$q->execute([get_session('user_id')]);

$count_notification = $q->rowCount();


