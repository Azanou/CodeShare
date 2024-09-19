<?php
session_start();

require('includes/init.php');
require('filters/auth_filter.php');


if(isset($_POST['publish'])){

    if(!empty($_POST['content'])){
        extract($_POST);
        
        create_micropost_for_the_current_user($content);

        set_flash('votre Post a ete publier');
    }
    redirect('profile.php?id='.get_session('user_id'));
}

