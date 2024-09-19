
<?php
session_start();

require('includes/init.php');
include('filters/guest_filter.php');
require('includes/constants.php');


// if the form have been submitted
if (isset($_POST['login'])) {
    if (not_empty(['identifiant', 'password'])) {

        extract($_POST);
        $q = $db->prepare("SELECT id , pseudo, password AS hashed_password, email, avatar FROM users WHERE (pseudo = :identifiant OR email = :identifiant) 
                            AND active ='1' ");
        $q->execute([
                    'identifiant' => $identifiant, 
                    ]);
        $user =  $q->fetch(PDO::FETCH_OBJ);
        

        if($user && password_verify($password, $user->hashed_password)){

            $_SESSION['user_id'] = $user->id;
            $_SESSION['pseudo'] = $user->pseudo;
            $_SESSION['avatar'] = $user->avatar;
            $_SESSION['email'] = $user->email;
            
            //if the user choosed to keep is session active
            if(isset($remember_me)&& $remember_me == 'on'){
               remember_me($user->id);
            }

            redirect_intent_or('profile.php?id='.$user->id);
        }else{
            save_input_data();
            set_flash('identifiant ou mot de passe incorrect','danger');
        }
    }
} else {
    clear_input_data();// if the user is just arriving on the page, all the fields of the form should always be empty !
}
require('views/login.view.php');
?>










