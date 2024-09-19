<?php include('includes/constants.php') ?>
<div class="parent">
    <div class="column">
        <h2><a href="index.php" class="navbar-brand"><?= WEBSITE_NAME ?></a></h2>
    </div>

    <div class="column">
        <a href="list_users.php" style="<?= set_active('list_users') ?>" class="nav-link fw-bold p-2"><?= $menu['liste_utilisateur'][$_SESSION['locale']] ?></a>
    </div>

    <div class="column searchStyle ">
        
            <div class="flexgap">
                <input type="search" placeholder="Recherchez un utilisateur... " class="form-control" id="searchbox">&nbsp;<i class="fa-solid fa-spinner fa-spin" style="display: none;" id="spinner"></i>
            </div>
            <div id="display-results">

            </div>
        
    </div>

    <div class="column">
        <!-- lang/theme -->
    </div>

    <div class="other_column">
        <?php if (is_logged_in()) : ?>

            <div class="dropdown">

                <button class="nav-link fw-bold dropbtn px-3 py-1">
                    <img src="<?= get_session('avatar') ? get_session('avatar') : get_avatar_url(get_session('email')) ?>" alt="<?= $menu['profile_de'][$_SESSION['locale']] ?><?= get_session('pseudo') ?>" style="border-radius:100%; width:25px; height: 25px;"></button>


                <div class="dropdown-content nodeco">
                    <li><a href="profile.php?id=<?= get_session('user_id') ?>"><?= $menu['mon_profil'][$_SESSION['locale']] ?></a></li>
                    <li><a href="edit_user.php?id=<?= get_session('user_id') ?>"><?= $menu['mon_profil_edition'][$_SESSION['locale']] ?></a></li>
                    <li><a href="share_code.php"><?= $menu['share_code'][$_SESSION['locale']] ?></a></li>
                    <li><a href="change_password.php?id=<?= get_session('user_id') ?>"><?= $menu['mon_password_change'][$_SESSION['locale']] ?></a></li>
                    <li style="border-top:solid #c4ccdb;"><a href="logout.php"><?= $menu['deconnexion'][$_SESSION['locale']] ?></a></li>
                </div>

            </div>
            <span class="py-1 <?= $count_notification > 0 ? 'have-notifs' : '' ?> nodeco">
                <a href="notifications.php"><i class="fa fa-bell" style="color:white"><?= $count_notification > 0 ? "($count_notification)" : '' ?></i></a>
            </span>

        <?php else : ?>

            <span style="<?= set_active('login') ?>"><a class="nav-link fw-bold py-1 px-3" href="login.php"><?= $menu['connexion'][$_SESSION['locale']] ?></a></span>

            <span style="<?= set_active('register') ?>"><a class="nav-link fw-bold py-1 px-3" href="register.php"><?= $menu['inscription'][$_SESSION['locale']] ?></a></span>
        <?php endif ?>


    </div>
</div>