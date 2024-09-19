<?php
$title = "Acceuil"
?>

<?php include('partials/_header.php') ?>

<main class="px-3"><br><br><br><br><br><br><br><br>
  <h1><?= WEBSITE_NAME ?> ?</h1><br>
    <?= $long_text['long_text'][$_SESSION['locale']] ?>

</main>
<?php include('partials/_footer.php') ?>
</div>
</body>

</html>