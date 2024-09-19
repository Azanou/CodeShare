<?php $title = "Affichage de codes sources"; ?>

<?php include('partials/_header.php') ?>

<div id="main-contain1">  
        <pre><code><?= e($data->code) ?></code></pre>
    <div class="btn-group nav">
        <a href="share_code.php?id=<?= $_GET['id']?>" class="btn btn-warning"><?= $menu['cloner'][$_SESSION['locale']] ?></a>
        <a href="share_code.php" class="btn btn-primary"><?= $menu['nouveau'][$_SESSION['locale']] ?></a>
    </div>
</div>


<script src="libraries/jquery.js"></script>
<script src="assets/highlight/highlight.min.js"></script>
<script src="assets/highlightjs-line-numbers/src/highlightjs-line-numbers.js"></script>
<script>
    hljs.highlightAll();
    hljs.initLineNumbersOnLoad();
</script>