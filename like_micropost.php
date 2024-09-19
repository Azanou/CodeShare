<?php
session_start();

require("includes/init.php");
require("filters/auth_filter.php");

if (!empty($_GET['id'])) {
   like_micropost($_GET['id']);
}
redirect('profile.php?id='.get_session('user_id').'#micropost'.$_GET['id']);
