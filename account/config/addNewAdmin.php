<?php
session_start();
require_once "connect.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$password_confirm = trim($_POST['password_confirm']);

if (preg_match("/^[\d\-+*%\/]+$/", $password)) {

    if ($password === $password_confirm) {

//    ----------------------- check that the entry has the same username
        $query_admin = $dbh->prepare("SELECT COUNT(*) FROM `admins` WHERE `login` = '$username'");
        $query_admin->execute();

        if ($query_admin->fetchColumn() > 0) {
            $_SESSION['msg'] = 'This login is already busy!';
            header('Location: ../view/admin/registerNewAdmin.php');
        } else {
//        $password = MD5($password);
            $ins = $dbh->exec("INSERT INTO `admins` (`id`, `login`, `password`) VALUES (NULL, '$username','$password')");

            $_SESSION['msg'] = 'You have successfully registered!';
            header('Location: ../view/admin/registerNewAdmin.php');
        }
//    -----------------------

    } else {
        $_SESSION['msg'] = 'Passwords do not match!';
        header('Location: ../view/admin/registerNewAdmin.php');
    }
} else {
    $_SESSION['msg'] = 'Invalid characters in password! Password must consist of numbers and % / * + -';
    header('Location: ../view/admin/registerNewAdmin.php');
}