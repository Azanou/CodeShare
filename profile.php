<?php
session_start();

require('includes/init.php');
include('filters/auth_filter.php');
require('includes/constants.php');

if (!empty($_GET['id'])) {

    $user = find_user_by_id($_GET['id']);

    if (!$user) {
        redirect('index.php');
    } else {
        try{
        $q = $db->prepare("SELECT U.id user_id, U.pseudo, U.email, U.avatar,M.id m_id, M.content,M.like_count, M.created_at
                            FROM users U, microposts M, friends_relationships F
                            WHERE M.user_id = U.id 
                                AND
                                    CASE
                                            WHEN F.user_id1 = :user_id
                                            THEN F.user_id2 = M.user_id
                                            
                                            WHEN F.user_id2 = :user_id
                                            THEN F.user_id1 = M.user_id
                                    END
                                AND F.status > 0
                                ORDER BY M.created_at DESC");
        $q->execute([
            'user_id' => $_GET["id"]
        ]);
        $microposts = $q->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        $e->getMessage();
    }
    }
} else {
    redirect('profile.php?id=' . get_session('user_id'));
}


require('views/profile.view.php');
?>





<script src="libraries/alertify/alertify.js"></script>
<script>
    $(document).ready(function() {
        // Vérifier le stockage local pour le statut de téléchargement
        var uploadStatus = localStorage.getItem('uploadStatus');
        if (uploadStatus === 'success') {
            alertify.success('Avatar uploadé avec succès.');
            // Supprimer le statut de succès après affichage du message
            localStorage.removeItem('uploadStatus');
        }
    });
</script>