<?php
session_start();
require_once "connect.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$check_admin_login = $dbh->prepare("SELECT * FROM `admins` WHERE `login` = '$username' AND `password` = '$password'");
$check_admin_login->execute();
$results = $check_admin_login->fetchAll();

foreach ($results as $result) {
    $admin_login = $result['login'];
    $admin_pass = $result['password'];
}

//    -----------------------
if ($username != $admin_login or $password != $admin_pass) {
    $check_user = $dbh->prepare("SELECT * FROM `users` WHERE `login` = '$username' AND `password` = '$password'");
    $check_user->execute();

    if ($check_user->rowCount() > 0) {
        $user = $check_user->fetchAll(PDO::FETCH_ASSOC);
        foreach ($user as $item) {
            $_SESSION['user_id'] = $item['id'];
            $_SESSION['user'] = $item['login'];
            $_SESSION['password'] = $item['password'];
            $_SESSION['chb'] = $item['blockage'];
        }

        if ($_SESSION['chb'] > 0) {
            $_SESSION['msg'] = 'Account blocked!';
            header('Location: ../view/index.php');
        }
        else {
            header('Location: ../view/profile/profile.php');
        }

    } else {
        $_SESSION['msg'] = 'Invalid login or password!';
        header('Location: ../view/index.php');
    }
} else {
//------============------------    ADMIN   ----------------==================-
    $check_admin = $dbh->prepare("SELECT * FROM `admins` WHERE `login` = '$username' AND `password` = '$password'");
    $check_admin->execute();

    if ($check_admin->rowCount() > 0) {
        $admin = $check_admin->fetchAll(PDO::FETCH_ASSOC);

        foreach ($admin as $item) {
            $_SESSION['admin_id'] = $item['id'];
            $_SESSION['admin'] = $item['login'];
            $_SESSION['admin_password'] = $item['password'];
        }
        header('Location: ../view/admin/admin.php');

    } else {
        $_SESSION['msg'] = 'Invalid login or password!';
        header('Location: ../view/index.php');
    }
}