<?php
session_start();
require_once "connect.php";

$sth = $dbh->prepare("SELECT * FROM admins where id=$_SESSION[admin_id]");
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
        $_SESSION['admin_id'] = $_POST['id'];
        $_SESSION['admin_password'] = $_POST['new_pass_confirm'];

        $stmt = $dbh->prepare("UPDATE `admins` SET  `password` = '$_SESSION[admin_password]' WHERE admins.id = '$_SESSION[admin_id]'");
        $stmt->execute();
//        if ($stmt) {
        $_SESSION['msg'] = 'You have successfully update!';
        header('Location: ../view/admin/admin.php');
//        }
    } else {
        $_SESSION['msg'] = 'Old password entered incorrectly or new passwords do not match!';
        header('Location: ../view/admin/changePassword.php?edit='. $_SESSION['admin_id']);
    }
}
