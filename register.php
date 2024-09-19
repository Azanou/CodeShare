<?php $title="Inscription"; ?>
<?php
session_start();

require('includes/init.php');
include('filters/guest_filter.php');
require('includes/constants.php');

// if the form have been submitted
if (isset($_POST['register'])) {
    if (not_empty(['name','pseudo','email','password','password_confirm']))
     {
        // array with the errors
        $errors = [];
        extract($_POST);

        if (mb_strlen($pseudo) < 3) {
            $errors[] = "Pseudo trop court ! minimun 3 caracteres.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Adresse email invalide !";
        }

        if (mb_strlen($password) < 8) {
            $errors[] = "Mot de passe trop court ! minimun 8 caracteres.";
        } else {
            if ($password != $password_confirm) {
                $errors[] = "Les deux mots de passe ne concordent pas !";
            }
        }

        if(is_already_in_use('pseudo',$pseudo,'users')){
            $errors[] = "pseudo deja utilise !";
        }

        if(is_already_in_use('email',$email,'users')){
            $errors[] = "Adresse E-mail deja utilise !";
        }

        if(count($errors) == 0){

            //send and activation Mail to the user
            // Tell the user to check is Mail-box !
            $to = $email;
            $subject = WEBSITE_NAME." - ACTIVATION DE COMPTE";
            $password = password_hash($password,PASSWORD_BCRYPT);
            $token = sha1($pseudo.$email.$password); // we'll use the Bcrypt algo here
             
            ob_start();
            require('templates/emails/activation.tmpl.php');
            $content = ob_get_clean();
            $headers = "MIME-Version:1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: mannkefirst@gmail.com";

            mail($to, $subject, $content, $headers);
            set_flash("Mail d'activation envoyer !", "success"); 

            $q = $db -> prepare('INSERT INTO users(name,pseudo,email,password)
                                                VALUES(:name,:pseudo,:email,:password)');
            $q->execute([
                'name' => $name,
                'pseudo' => $pseudo,
                'email' => $email,
                'password' =>$password// here also Bcrypt to store password into BD !!
            ]);

            redirect('index.php');
        }else{
            save_input_data();
        }

    } else {
        $errors[] = "veuillez remplir tous les champs s'il vous plait";
        save_input_data(); 
    }
}else{
    clear_input_data();
}
require('views/register.view.php');
?>










