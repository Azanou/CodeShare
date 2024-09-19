<?php
session_start();
require("../config/database.php");
require("../includes/functions.php");

extract($_POST);

if ($action == "like") {
    if (user_has_already_liked($micropost_id)) {
        $white = "white";
        unlike_micropost($micropost_id);

        $total_number_of_likes_for_this_micropost = get_like_count($micropost_id);

        $data = [
            "color" => $white,
            "all_likes" => $total_number_of_likes_for_this_micropost,
            "likers" => get_likers_text($micropost_id)
        ];
        echo json_encode($data);
        return;
    }

    like_micropost($micropost_id);
} else {

    unlike_micropost($micropost_id);
}

$total_number_of_likes_for_this_micropost = get_like_count($micropost_id);

$data = [
    "color" => "",
    "all_likes" => $total_number_of_likes_for_this_micropost,
    "likers" => get_likers_text($micropost_id)
];

echo json_encode($data);
