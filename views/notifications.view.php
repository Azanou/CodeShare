<?php $title = "Notification" ?>

<?php include('partials/_header.php') ?>

<div id="main-content">
    <div class="container">
        <h1>Vos notifications</h1>
        <ul class="list-group">
            <?php foreach ($notifications as $notification): ?>
                <li class="list-group-item <?= $notification->seen == '0' ? 'not_seen' : '' ?>">
                    <?php require("partials/notifications/{$notification->name}.php"); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div id="pagination"><?= $pagination ?></div>
    </div>
</div>

<?php include('partials/_footer.php'); ?>

<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".timeago").timeago();
    });
</script>