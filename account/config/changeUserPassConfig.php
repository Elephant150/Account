<?php
session_start();
require_once "connect.php";

$sth = $dbh->prepare("SELECT * FROM `users` where id=$_SESSION[user_id]");
$sth->execute();
$res = $sth->fetchAll();
//
foreach ($res as $re) {
    $id = $re['id'];
    $login = $re['login'];
    $pass = $re['password'];
}


if (isset($_POST['edit'])) {
    if ($_POST['old_password'] === $pass and $_POST['new_pass'] === $_POST['new_pass_confirm']) {
        if (preg_match("/^[\d\-+*%\/]+$/", $_POST['new_pass_confirm'])) {
            $_SESSION['user_id'] = $_POST['id'];
            $_SESSION['password'] = $_POST['new_pass_confirm'];
            $date_update = date('Y-m-d');
            $stmt = $dbh->prepare("UPDATE `users` SET  `password` = '$_SESSION[password]', `date_update` = '$date_update' WHERE users.id = '$_SESSION[user_id]'");
            $stmt->execute();
            $_SESSION['msg'] = 'You have successfully update!';
            header('Location: ../view/profile/profile.php');
        } else {
            $_SESSION['msg'] = 'Invalid characters in password! Password must consist of numbers and % / * + -';
            header('Location: ../view/profile/profile.php');
        }

    } else {
        $_SESSION['msg'] = 'Old password entered incorrectly or new passwords do not match!';
        header('Location: ../view/profile/changeUserPassword.php?edit=' . $_SESSION['user_id']);
    }
}

