<?php
session_start();
require_once "connect.php";

$full_name = trim($_POST['full_name']);
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$password_confirm = trim($_POST['password_confirm']);

//    ----------------------- password verification
if ($password === $password_confirm) {

//    ----------------------- uploads a picture
    $path = '/uploads/' . time() . $_FILES['picture']['name'];
    if (!move_uploaded_file($_FILES['picture']['tmp_name'], '../' . $path)) {
        $_SESSION['msg'] = 'Error loading image!';
        header('Location: ../register.php');
    }
//    -----------------------

//    ----------------------- check that the entry has the same username
    $query = $dbh->prepare("SELECT COUNT(*) FROM `users` WHERE `login` = '$username'");
    $query->execute();

    if ($query->fetchColumn() > 0) {
        $_SESSION['msg'] = 'This login is already busy!';
        header('Location: ../register.php');
    } else {
        $password = MD5($password);
        $ins = $dbh->exec("INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `picture`) VALUES (NULL, '$full_name', '$username', '$email', '$password', '$path')");

        $_SESSION['msg'] = 'You have successfully registered!';
        header('Location: ../index.php');
    }
//    -----------------------

} else {
    $_SESSION['msg'] = 'Passwords do not match!';
    header('Location: ../register.php');
}
