
<?php
session_start();

require('includes/init.php');
include('filters/auth_filter.php');
require('includes/constants.php');


if (!empty($_GET['id'])) {

   $data = find_code_by_id($_GET['id']);
    if (!$data) {
        $code = '';
    }else{
        $code = $data->code;
    }
} else {
    $code = "";
}

//if the form have been submitted
if (isset($_POST['save'])) {
    if (not_empty(['code'])) {

        extract($_POST);
        $q = $db->prepare("INSERT INTO codes(code) VALUES (:code)");
        $success = $q->execute(['code' => $code]);

        if ($success) {
            //all've been well
            $id = $db->lastInsertId();
            $fullUrl = WEBSITE_URL."/show_code.php?id=".$id;
            create_micropost_for_the_current_user("Je viens de publier un nouveau code source:\n".$fullUrl);
            redirect('show_code.php?id=' . $id);
        } else {
            set_flash("Erreur lors de l'ajout du code, veuillez reessayer", "error");
            redirect('share_code.php');
        }
    } else {
        redirect('share_code.php');
    }
}

require('views/share_code.view.php');
