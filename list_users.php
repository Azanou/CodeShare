<?php
session_start();

require('includes/init.php');
require('includes/constants.php');


$req = $db->query("SELECT id FROM users WHERE active='1' ");

$nombres_users = $req->rowCount();
$nombres_users_page = 12;
$nombre_pages_max_av_ap = 2;
$last_page = ceil($nombres_users / $nombres_users_page);

if ($nombres_users >= 1) {

    if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
        $page_num = $_GET["page"];
    } else {
        $page_num = 1;
    }
    if ($page_num < 1) {
        $page_num = 1;
    } else if ($page_num > $last_page) {
        $page_num = $last_page;
    }

    $limit = ' LIMIT ' . ($page_num - 1) * $nombres_users_page . ',' . $nombres_users_page;

    $q = $db->query("SELECT id,avatar, pseudo, email FROM users WHERE active='1' $limit");
    $users = $q->fetchAll(PDO::FETCH_OBJ);
    $pagination = '<nav><ul class="pagination pagination-sm justify-content-end ">';


    if ($last_page != 1) {
        if ($page_num > 1) {
            $previous = $page_num - 1;
            $pagination .= '<li class="page-item"><a aria-label="Previous" style="background:#212836;border-color:#151a22;" class="page-link" href="list_users.php?page=' . $previous . ' "><span aria-hidden="true">&laquo;</span></a></li>';

            for ($i = $page_num - $nombre_pages_max_av_ap; $i < $page_num; $i++) {
                if ($i > 0) {
                    $pagination .= '<li class="page-item"><a style="background:#212836;border-color:#151a22;" class="page-link" href="list_users.php?page=' . $i . ' ">' . $i . '</a></li>';
                }
            }
        }
        $pagination .= '<li class="page-item"><a class="page-link" style="background:#1648ad;border-color:#151a22;color:white;">' . $page_num . '</a></li>';

        for ($i = $page_num + 1; $i < $last_page; $i++) {
            $pagination .= '<li class="page-item"><a class="page-link" style="background:#212836;border-color:#151a22;" href="list_users.php?page=' . $i . ' ">' . $i . '</a></li>';

            if ($i >= $page_num + $nombre_pages_max_av_ap) break;
        }

        if ($page_num != $last_page) {
            $next = $page_num + 1;
            $pagination .= '<li class="page-item"><a aria-label="Next" style="background:#212836;border-color:#151a22;" class="page-link "  href="list_users.php?page=' . $next . ' "><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    $pagination .= "</ul></nav>";
require('views/list_users.view.php');
} else{
    set_flash('Aucun utilisateur pour le moment...');
    redirect('index.php');
}