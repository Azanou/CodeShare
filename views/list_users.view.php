<?php $title = "Liste des utilisateurs"; ?>

<?php include('partials/_header.php') ?>

<div id="main-content">
    <div class="container"><br>
        <h1><?= $menu['liste_utilisateur'][$_SESSION['locale']] ?></h1><br>

        <?php foreach (array_chunk($users, 4) as $user_set) : ?>
            <div class="row user">
                <?php foreach ($user_set as $user) : ?>
                    <div class="col-md-3 user-block">
                        <a href="profile.php?id=<?= $user->id ?>">
                            <img src="<?= $user->avatar ?:get_avatar_url($user->email, 70) ?>" class="avatar" alt="<?= e($user->pseudo) ?>" style="border-radius:100%;width:100px;height: 100px;">
                        </a>
                        <h4 class="user-block-username">
                            <a href="profile.php?id=<?= $user->id ?>">
                                <?= e($user->pseudo) ?>
                            </a>
                        </h4>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <div id='pagination' ><?= $pagination ?></div>
    </div>
</div>
<?php include('partials/_footer.php') ?>