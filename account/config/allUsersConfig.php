<?php
require_once 'connect.php';

$all_data = $dbh->prepare("select * from `users` order by `id` desc");
$all_data->execute();
$results = $all_data->fetchAll();

if (isset($_GET['del'])) {
    $del = $_GET['del'];
    $delete = $dbh->query("delete from users where id=$del");
    header('location: ../view/admin/allUsers.php');
}

foreach ($results as $result) {
    $id = $result['id'];
    $login = $result['login'];
    $password = $result['password'];
    $blockage = $result['blockage'];
}

    if (isset($_GET['block'])) {
        $block = $_GET['block'];
        $block_user = $dbh->prepare("UPDATE `users` SET  `blockage` = '1' WHERE users.id = '$block'");
        $block_user->execute();
        header('location: ../view/admin/allUsers.php');
    }

if (isset($_GET['unblock'])) {
    $unblock = $_GET['unblock'];
    $unblock_user = $dbh->prepare("UPDATE `users` SET  `blockage` = '0' WHERE users.id = '$unblock'");
    $unblock_user->execute();
    header('location: ../view/admin/allUsers.php');
}
