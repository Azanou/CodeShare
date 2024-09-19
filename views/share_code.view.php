<?php $title = "Partage de codes sources"; ?>

<?php include('partials/_header.php') ?>

<div id="main-contain">
            <form method="post" autocomplete="off">  
                <textarea name="code" id="code" placeholder="<?= $menu['entrer_le_code'][$_SESSION['locale']] ?>" ><?= e($code); ?></textarea>
                <div class="btn-group">
                    <a href="share_code.php" class="btn btn-danger"><?= $menu['tout_effacer'][$_SESSION['locale']] ?></a>
                    <input type="submit" class="btn btn-success" name="save" value="<?= $menu['enregistrer'][$_SESSION['locale']] ?>">
                </div>
            </form>
</div>


<script src="libraries/jquery.js"></script>
<script src="assets/js/tabby.min.js"></script>

<script>
    $("#code").tabby();   
    $('#code').height($(window).height()-50);
</script>