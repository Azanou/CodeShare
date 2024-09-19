<?php $title="Inscription"; ?>

<?php include('partials/_header.php')?>

<div id="main-contain">
    <div class="container"><br><br>
        <h1 class="text-center"><?= $menu['devenir_membre'][$_SESSION['locale']] ?></h1>

        <?php include('partials/_errors.php') ?>
        
        <form method="post" class="col-md-8" style="margin:20px 220px;" autocomplete="off" data-parsley-validate >
            <div class="form-group">
                <label  class="control-label" for="name"><?= $menu['nom'][$_SESSION['locale']] ?>:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?=get_input('name') ?>" style="width: 500px; margin:auto;" required><br>

                <label  class="control-label" for="pseudo">Pseudo:</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?=get_input('pseudo') ?>" style="width: 500px; margin:auto;" required><br>

                <label  class="control-label" for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?=get_input('email') ?>" style="width: 500px; margin:auto;" required><br>

                <label  class="control-label" for="password"><?= $menu['mot_de_passe'][$_SESSION['locale']] ?>:</label>
                <input type="password" class="form-control" id="password" name="password" style="width: 500px; margin:auto;" required><br>

                <label  class="control-label" for="password_confirm"><?= $menu['confirmez_mot_de_passe'][$_SESSION['locale']] ?>:</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" style="width: 500px; margin:auto;"
                        required data-parsley-equalto="#password"><br>

                <input type="submit" class="btn btn-primary" name="register" value="<?= $menu['inscription'][$_SESSION['locale']] ?>" required>
            </div>
        </form>
    </div>
    
</div>
<?php include('partials/_footer.php')?>