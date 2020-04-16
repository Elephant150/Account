<?php
session_start();
require_once "connect.php";

if (isset($_POST['reserve'])) {
    $login = trim($_POST['login']);

//    ----------------------- check that the entry has the same username
    $query = $dbh->prepare("SELECT COUNT(*) FROM `users` WHERE `login` = '$login'");
    $query->execute();

    if ($query->fetchColumn() > 0) {
        $_SESSION['msg'] = 'This login is already busy!';
        header('Location: ../view/admin/reserveLogin.php');
    } else {
        $ins = $dbh->exec("INSERT INTO `reserved_login` (`id`, `login`) VALUES (NULL, '$login')");

        $_SESSION['msg'] = 'Reserved successfully!';
        header('Location: ../view/admin/reservedList.php');
    }

}