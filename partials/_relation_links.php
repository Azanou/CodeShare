<?php if (relation_link_to_display($_GET['id']) == CANCEL_RELATION_LINK): ?>
    <br><br><i class="fa fa-clock-o"></i> En attente... <br><a href='<?= "delete_friend.php?id=" . $_GET['id'] ?>' style="padding-block-end: 60px;">Annuler la demande</a>

<?php elseif (relation_link_to_display($_GET['id']) == ACCEPT_REJECT_RELATION_LINK) : ?>
    <div class="div" style="margin:40px 0px 0px 50px;">
        <a href="<?= 'accept_friend_request.php?id=' . $_GET['id'] ?> " class="btn btn-primary">Accepter</a>
        <a href="<?= 'delete_friend.php?id=' . $_GET['id'] ?>" class="btn btn-danger">Decliner</a>
    </div>

<?php elseif (relation_link_to_display($_GET['id']) == DELETE_RELATION_LINK) : ?>
   <br><br tabindex="5">Vous etes amis!<br><a href="<?= 'delete_friend.php?id=' . $_GET['id'] ?>" class="btn btn-danger" style="margin:20px 0px 0px 50px;" >supprimer cette connexion</a>

<?php elseif(relation_link_to_display($_GET['id']) == ADD_RELATION_LINK) : ?>
    <a href=<?= "add_friend.php?id=" . $_GET['id'] ?> class="btn btn-primary" style="margin:30px 0px 0px 100px;"><i class="fa fa-plus"></i> Connecter</a>
<?php endif; ?>