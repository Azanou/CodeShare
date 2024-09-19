<?php $title = "Edition Profile"; ?>

<?php include('partials/_header.php') ?>



<div id="main-contain">
    <div class="container"><br>
        <div class="row">
            <?php if (!empty($_GET['id']) && $_GET['id'] === get_session('user_id')) : ?>
                <div class="col-md-6" style="margin-left: 25%;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="background:#171b24;border-radius:15px 15px 0px 0px;"><?= $menu['completer_profile'][$_SESSION['locale']] ?></h3>
                        </div>
                        <div class="panel-body" style="background:#252c3a;border-radius:0px 0px 15px 15px ;">
                            <?php include('partials/_errors.php') ?>

                            <form method="post" autocomplete="off" class="p-3 m-1" data-parsley-validate>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><?= $menu['nom'][$_SESSION['locale']] ?><span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" value="<?= get_input('name') ? get_input('name') : e($user->name) ?>" class="form-control" placeholder="john" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city"><?= $menu['ville'][$_SESSION['locale']] ?><span class="text-danger">*</span></label>
                                            <input type="text" name="city" id="city" value="<?= get_input('city') ? get_input('city') : e($user->city) ?>" class="form-control" placeholder="town" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="change">Changer mon avatar:</label><br>
                                            <input type="file" name="avatar" id="avatar">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country"><?= $menu['pays'][$_SESSION['locale']] ?><span class="text-danger">*</span></label>
                                            <input type="text" name="country" id="country" value="<?= get_input('country') ? get_input('country') : e($user->country) ?>" class="form-control" placeholder="country" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sex"><?= $menu['sexe'][$_SESSION['locale']] ?><span class="text-danger">*</span></label>
                                            <select name="sex" id="sex" value="<?= e($user->sex) ?>" class="form-control" required>
                                                <option value="H" <?php $user->sex == "H" ? "selected" : ""  ?>>
                                                    <?= $menu['homme'][$_SESSION['locale']] ?>
                                                </option>
                                                <option value="F" <?php $user->sex == "H" ? "selected" : ""  ?>>
                                                    <?= $menu['femme'][$_SESSION['locale']] ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="x">GitHub</label>
                                            <input type="text" name="github" id="github" value="<?= get_input('github') ? get_input('github') : e($user->github) ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="twitter">X (twitter)</label>
                                            <input type="text" name="twitter" id="twitter" value="<?= get_input('twitter') ? get_input('twitter') : e($user->twitter) ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="available_for_hire">
                                                <input type="checkbox" name="available_for_hiring" id="available_for_hiring" <?= $user->available_for_hiring ? "checked" : "" ?>>
                                                <?= $menu['dispo'][$_SESSION['locale']] ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group py-2">
                                            <label for="bio"><?= $menu['biographie'][$_SESSION['locale']] ?>:<span class="text-danger">*</label>
                                            <textarea name="bio" id="bio" cols="30" rows="10" placeholder="j'aime programmer et travailler en equipe ! " class="form-control"><?= get_input('bio') ? get_input('bio') : e($user->bio) ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="submit" name="update" value="<?= $menu['valider'][$_SESSION['locale']] ?>" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include('partials/_footer.php') ?>
<script src="libraries/uploadifive/jquery.uploadifive.min.js"></script>
<script src="libraries/alertify/alertify.js"></script>

<script>
    <?php $timestamp = time(); ?>
    $(function() {
        $('#avatar').uploadifive({
            'auto': true,
            'multi':false,
            'buttonText': 'Parcourir',
            'fileType': '.jpg,.jpeg,.gif,.png',
            'fileObjName': 'avatar',
            'formData': {
                'timestamp': '<?php echo $timestamp; ?>',
                'token': '<?php echo md5('unique_salt' . $timestamp); ?>',
                'user_id': '<?= get_session('user_id'); ?>'
            },
            'uploadScript': 'libraries/uploadifive/uploadifive.php',
            'onUploadComplete': function(file, data) {
                console.log(data);
                localStorage.setItem('uploadStatus', 'success');
                window.location = "/codeShare/profile.php?";
                
                
            },
            'onError': function(file, errorCode, errorMsg, errorString) {
                // Afficher un message d'erreur
                alertify.error("Erreur lors du telechargement du fichier, veuillez verifier le format et reesayez");
            }
        });
    });
</script>