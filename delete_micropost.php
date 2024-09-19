<?php
session_start();

require("includes/init.php");
include('filters/auth_filter.php');

if (!empty($_GET['id'])) {
    try {
        $q = $db->prepare('SELECT user_id FROM microposts WHERE microposts.id = :id');
        $q->execute([
            'id' => $_GET['id']
        ]);
        $data = $q->fetch(PDO::FETCH_OBJ);
        $user_id = $data->user_id;
        if ($user_id == get_session('user_id')) {

            $q = $db -> prepare("DELETE FROM micropost_like WHERE micropost_id = ?");
            $q->execute([ $_GET['id'] ]);

            $q = $db->prepare('DELETE FROM microposts WHERE microposts.id = :id');
            $q->execute([
                'id' => $_GET['id']
            ]);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    set_flash("Votre publication a été supprimée avec succès!");
}
redirect('profile.php?id=' . get_session('user_id'));
