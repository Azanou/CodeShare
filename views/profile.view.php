<?php $title = "Profile"; ?>

<?php include('partials/_header.php') ?>

<div id="main-contain">
    <div class="container"><br>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="background:#171b24;border-radius:15px 15px 0px 0px;">
                            <?= $menu['profile de'][$_SESSION['locale']] ?></a><?= e($user->pseudo) ?> (<?= friends_count($_GET['id']) ?> connection<?= friends_count($_GET['id']) == 1 ? '' : 's' ?>)</h3>
                    </div>
                    <div class="panel-body" style="background:#252c3a;border-radius:0px 0px 15px 15px ;">
                        <div class="row">
                            <div class="col-md-6 py-3">
                                <img src="<?= isset($user->avatar) ? $user->avatar : get_avatar_url($user->email, 100) ?>" alt="<?= $menu['image_prof'][$_SESSION['locale']] ?> <?= e($user->pseudo) ?>" style="border-radius:100%; height:150px; width: 150px;align-items:center;">
                            </div>
                            <div class="col-md-6">
                                <?php if (isset($_GET['id']) && $_GET['id'] !== get_session('user_id')) : ?>
                                    <?php include('partials/_relation_links.php') ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 p-3">
                                <strong><?= e($user->pseudo) ?></strong><br>
                                <a href="mailto:<?= e($user->email) ?>"><?= e($user->email) ?></a><br>
                                <?=
                                $user->city && $user->country ? '<i class="fa fa-location-arrow"></i>&nbsp;' . e($user->city) . '-' . e($user->country) . '</br>' : '';
                                if ($user->city && $user->country) {
                                    echo '<a href="https://www.google.com/maps?q=' . e($user->city) . ' ' . e($user->country) . ' "target="_blank">' . $menu["voir_sur_google"][$_SESSION["locale"]] . '</a>';
                                }
                                ?>
                            </div>
                            <div class="col-md-6 p-3">
                                <?=
                                $user->twitter ? '<i class="fa-brands fa-x-twitter"></i>&nbsp;<a href="https://www.x.com/' . e($user->twitter) . '">@' . e($user->twitter) . '</a></br>' : '';
                                ?>
                                <?=
                                $user->github ? '<i class="fa-brands fa-github"></i>&nbsp;<a href="https://github.com/' . e($user->github) . '">' . e($user->github) . '</a></br>' : '';
                                ?>
                                <?=
                                $user->sex == "H" ? "<i class='fa-solid fa-person'></i>" : "<i class='fa-solid fa-female'></i>";
                                ?>
                                <?=
                                $user->available_for_hiring ?  $menu['dispo'][$_SESSION['locale']] : $menu['non_dispo'][$_SESSION['locale']];
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 m-auto my-3 py-1" style="text-align: left; background:#212836; border-radius:10px;">
                                <h5><?= $menu['biographie_of'][$_SESSION['locale']] ?><?= e($user->name) ?></h5>
                                <p>
                                    <?=
                                    $user->bio ? nl2br(e($user->bio)) : "Aucune biographie pour le moment...";
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-6">
                <?php if (!empty($_GET['id']) && $_GET['id'] === get_session("user_id")) : ?>
                    <div class="status-post">
                        <form action="microposts.php" method="post" data-parsley-validate>
                            <div class="form-group">
                                <textarea name="content" id="content" rows="3" class="form-control" placeholder="Creez un Post..." required></textarea>
                            </div>
                            <div class="form-group status-post-submit">
                                <input type="submit" name="publish" value="publier" class="btn btn-primary btn-sm">
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
                    <?php if ( current_user_is_friend_with($_GET['id']) ): ?>
                        <?php if (count($microposts) != 0) : ?>
                            <?php foreach ($microposts as $micropost) : ?>
                                <?php include('partials/_micropost.php') ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <br>
                            <p>Vous n'avez rien publier pour le moment..</p>
                        <?php endif ?>
                    <?php else : ?>
                        <br>
                        <p>no friends :</p>
                    <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?php include('partials/_footer.php') ?>

<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>


<script>
    $(document).ready(function() {
        $("span.timeago").timeago();

        $("a.like").on('click', function(event) {
            event.preventDefault();
            var action = $(this).data("action");
            // equivalent to what is above ----->> var action =  $(this).data("action");
            var id = $(this).attr("id");
            var micropostId = id.split("like")[1]
            var color = $(this).attr("style").split(":")[1]
            //var data = "micropost_id=" + micropostId + "&action="+ action
            var url = "ajax/micropost_like.php"

            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                data: {
                    micropost_id: micropostId,
                    action: action
                },
                success: function(response) {
                    $("#likers_" + micropostId).html(response["likers"]);
                    $("#bla_" + micropostId).html(response["all_likes"])

                    if (action == "like") {
                        if (response["color"] === "white") {
                            $("#" + id).css('color', 'white')
                        } else {
                            $("#" + id).css('color', '#4177e2')
                        }
                        $("#" + "un" + id).css('color', 'white')
                    } else {
                        $("#" + id).css('color', '#4177e2')
                        var id_of_like = id.split("un")[1]
                        $("#" + id_of_like).css('color', 'white')
                    }
                }
            })
        });
    });
</script>

</div>
</body>

</html>