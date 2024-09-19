<?php

session_start();
require("../config/database.php");
require("../includes/functions.php");

extract($_POST);


$q = $db->prepare(
    'SELECT id, email, name, avatar, pseudo FROM users
                   WHERE (name LIKE :query OR pseudo LIKE :query OR email LIKE :query ) LIMIT 5 '
);

$q->execute([
    'query' => '%' . $query . '%'
]);

$users = $q->fetchAll(PDO::FETCH_OBJ);
if(count($users) > 0){
foreach ($users as $user) {
?>
    <div class="display-box-user">
        <a href="profile.php?id=<?= e($user->id) ?>" style="text-decoration: none; color:black">
            <img src="<?= e($user->avatar) ?: get_avatar_url($user->avatar, 15)?>" alt="<?= e($user->pseudo) ?>" style="border-radius:100%; height:30px; width:30px;">
            &nbsp;<?= e($user->name )?><br><?= e($user->email) ?>
        </a>
    </div>
<?php
}
}else{
    echo '<div class="display-box-user"><p><b>Aucun utilisateur trouver</b></p></div>';
}
