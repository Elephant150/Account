<?php
session_start();
require_once "connect.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$password_confirm = trim($_POST['password_confirm']);
$date = date('Y-m-d');

$check_reserve_login = $dbh->prepare("SELECT * FROM `reserved_login` WHERE `login` = '$username'");
$check_reserve_login->execute();
$results = $check_reserve_login->fetchAll();

foreach ($results as $result) {
    $reserve_login = $result['login'];
}
if ($username != $reserve_login) {
    if (preg_match("/^[\d\-+*%\/]+$/", $password)) {
        if ($password === $password_confirm) {

            //    ----------------------- check that the entry has the same username
            $query = $dbh->prepare("SELECT COUNT(*) FROM `users` WHERE `login` = '$username'");
            $query->execute();

            if ($query->fetchColumn() > 0) {
                $_SESSION['msg'] = 'This login is already busy!';
                header('Location: ../view/register.php');
            } else {
                $insert = $dbh->query("INSERT INTO `users` (`id`, `login`, `password`,`date`, `date_update`, `blockage`) VALUES (NULL, '$username','$password', '$date', '', '0')");

                $_SESSION['msg'] = 'You have successfully registered!';
                header('Location: ../view/index.php');
            }

        } else {
            $_SESSION['msg'] = 'Passwords do not match!';
            header('Location: ../view/register.php');
        }
    } else {
        $_SESSION['msg'] = 'Invalid characters in password! Password must consist of numbers and % / * + -';
        header('Location: ../view/register.php');
    }
} else {
    $_SESSION['msg'] = 'This login is reserved! Please enter another login!';
    header('Location: ../view/register.php');
}

