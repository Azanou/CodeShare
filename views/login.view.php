<?php $title = "Connexion"; ?>

<?php include('partials/_header.php')?>

<div id="main-contain">
    <div class="container"><br><br>
        <h1 class="text-center"><?= $menu['connexion'][$_SESSION['locale']] ?></h1>

        <?php include('partials/_errors.php') ?>
        <form method="post" class="col-md-8" style="margin:20px 220px;" autocomplete="off" data-parsley-validate >
            <div class="form-group">
                <!--champ pour l'identifiant-->
                <label  class="control-label" for="identifiant"><?= $menu['pseudo_ou_adresse_email'][$_SESSION['locale']] ?></label>
                <input type="text" class="form-control" id="identifiant" name="identifiant" value="<?=get_input('identifiant') ?>" style="width: 500px; margin:auto;" required><br>
                <!--champ pour le mot de passe-->
                <label  class="control-label" for="password"><?= $menu['mot_de_passe'][$_SESSION['locale']] ?>:</label>
                <input type="password" class="form-control" id="password" name="password" style="width: 500px; margin:auto;" required>
                <!--remember_mr -->
                <label  class="control-label" for="remember_me"><?= $menu['sauvegarder_session'][$_SESSION['locale']] ?>
                    <input type="checkbox" name="remember_me" id="remember_me">
                </label><br><br>
                    <!-- connexion button -->
                <input type="submit" class="btn btn-primary" name="login" value="<?= $menu['connexion'][$_SESSION['locale']] ?>" required>
            </div>
        </form>
    </div>
    
</div>
<?php include('partials/_footer.php')?>