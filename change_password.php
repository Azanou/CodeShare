<?php
session_start();

require('includes/init.php');
require('filters/auth_filter.php');
require('includes/constants.php');



if (isset($_POST['change_password'])) {
    if (not_empty(['current_password', 'new_password', 'new_password_confirmation'])) {
        //global $db;
        extract($_POST);
        $errors = [];
        if (mb_strlen($new_password) < 8) {
            $errors[] = "Nouveau mot de passe trop court! minimum 8 caracteres.";
        } else {
            if ($new_password != $new_password_confirmation) {
                $errors[] = "Les deux mots de passe ne concordent pas !";
            }
        }

        if (count($errors) == 0) {

            $q = $db->prepare("SELECT password AS hashed_password FROM users 
                                WHERE id = :id AND active = '1' ");
            $q->execute([
                'id' => get_session('user_id')
            ]);
            $user =  $q->fetch(PDO::FETCH_OBJ);


            if (!empty($user) && password_verify($current_password, $user->hashed_password)) {

                $q = $db->prepare("UPDATE users SET password = :password WHERE id = :id ");
                $q->execute([
                    'password' => password_hash($new_password, PASSWORD_BCRYPT),
                    'id' => get_session('user_id')
                ]);
                set_flash('Felicitation! votre mot de passe a été mis a jour');
                redirect('profile.php?id=' . get_session('user_id'));
            } else {
                save_input_data();
                $errors[] = "Le mot de passe indiquer est incorrecte";
            }
        }
    }
} else {
    clear_input_data(); //if the user is just arriving on the page, all the fields of the form should always be empty !
}

require('views/change_password.view.php');
