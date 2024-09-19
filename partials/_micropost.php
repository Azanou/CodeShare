<article class="article-container" id="micropost<?= $micropost->m_id ?>">
    <div class="header">
        <img src="<?= $micropost->avatar ?: get_avatar_url($micropost->email) ?>" alt="<?= $micropost->pseudo ?>" class="image" style="border-radius: 100%;margin-bottom:1px;">
        <div class="name-date">
            <div class="name"><?= $micropost->pseudo ?></div>
        </div>
    </div>

    <div class="align-date-delete">

        <div class="date"><i class="fa fa-clock-o"></i> <span class="timeago" title="<?= $micropost->created_at ?>"><?= $micropost->created_at ?></span></div>

        <?php if ($micropost->user_id == get_session('user_id')): ?>
            <a data-confirm="Voulez-vous vraiment supprimer cette publication ?" href="delete_micropost.php?id=<?= $micropost->m_id ?>" class="px-2" style="text-decoration: none;"><i class="fa fa-trash"></i> Supprimer</a>
        <?php endif; ?>

    </div>
    <div class="content">
        <p><?= nl2br(replace_links(e($micropost->content))) ?></p>
        <hr>
    </div>

    <div style="display: flex; margin-left:35px;">
        <div>

            <a data-action="like" id="like<?= $micropost->m_id ?>" href="like_micropost.php?id=<?= $micropost->m_id ?>" class="like"  style="color: white;" ><i class="fa-solid fa-thumbs-up"></i></a>

            <span id="bla_<?= $micropost->m_id ?>" style="margin-right: 2px;"><?= $micropost->like_count ?></span>

            <a data-action="unlike" id="unlike<?= $micropost->m_id ?>" href="unlike_micropost.php?id=<?= $micropost->m_id ?>" class="like" style="color: white;" ><i class="fa-solid fa-thumbs-up fa-rotate-180"></i></a>
        </div>

        <div id="likers_<?= $micropost->m_id ?>" style="margin-left: 10px;">
            <?= get_likers_text($micropost->m_id); ?>
        </div>
    </div>
</article>