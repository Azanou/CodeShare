<?php
session_start();

require('includes/init.php');
include('filters/auth_filter.php');
require('includes/constants.php');



if (!empty($_GET['id']) && $_GET['id'] === get_session('user_id')){

    $user = find_user_by_id($_GET['id']);
    
    if (!$user) {
        redirect('index.php');
    }
   
} else {
    redirect('profile.php?id='.get_session('user_id'));
}


if (isset($_POST['update'])) {
    if (not_empty(['name', 'city','country','sex','bio'])){

        extract($_POST);
        $errors = [];
        $q = $db->prepare("UPDATE users SET
                            name = :name,
                            city = :city,country = :country,
                             sex = :sex, twitter = :twitter,
                            github = :github, available_for_hiring = :available_for_hiring, bio = :bio
                            WHERE id= :id");
        $q->execute([
                    'name' => $name, 
                    'city' => $city,
                    'country' => $country,
                    'sex' => $sex,
                    'twitter' => $twitter,
                    'github' => $github,
                    'available_for_hiring' => !empty($available_for_hiring)? '1':'0',
                    'bio' => $bio,
                    'id' => get_session('user_id') 
                    ]);
        set_flash('Felicitation! votre profile a été mis a jour');
         
        redirect('profile.php?id='.get_session('user_id'));
    }else{
        save_input_data();
        $errors = ["veuillez remplir tous les champs marqués d'un (*)"];  
    }
} else {
    clear_input_data();// if the user is just arriving on the page, all the fields of the form should always be empty !
}

require('views/edit_user.view.php');
