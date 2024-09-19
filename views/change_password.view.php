<?php $title = $menu['titre_password_change'][$_SESSION['locale']]; ?>

<?php include('partials/_header.php') ?>



<div id="main-contain">
    <div class="container"><br>
        <div class="row">
                <div class="col-md-6" style="margin-left: 25%;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="background:#171b24;border-radius:15px 15px 0px 0px;"><?= $menu['titre_password_change'][$_SESSION['locale']] ?></h3>
                        </div>
                        <div class="panel-body" style="background:#252c3a;border-radius:0px 0px 15px 15px ;">
                            <?php include('partials/_errors.php') ?>

                            <form method="post" autocomplete="off" class="p-3 m-1" data-parsley-validate>
                                <div class="form-group">
                                    <br><label for="name">Entrez votre mot de passe<span class="text-danger">*</span></label>
                                    <input type="password" name="current_password" id="current_password" class="form-control" required><br>

                                    <label for="name">Entrez votre nouveau mot de passe<span class="text-danger">*</span></label>
                                    <input type="password" name="new_password" id="new_password" class="form-control" required ><br>

                                    <label for="name">Confirmez le nouveau mot de passe<span class="text-danger">*</span></label>
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" data-parsley-equalto="#new_password"  required><br>
                                </div>
                                <input type="submit" class="btn btn-primary" value="valider" name="change_password">
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php include('partials/_footer.php') ?>