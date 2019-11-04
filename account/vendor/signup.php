<?php
session_start();
require_once "connect.php";

$full_name = trim($_POST['full_name']);
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$password_confirm = trim($_POST['password_confirm']);

if ($password === $password_confirm) {
    $path = 'uploads/' . time() . $_FILES['picture']['name'];
    if (!move_uploaded_file($_FILES['picture']['tmp_name'], '../' . $path)){
        $_SESSION['msg'] = 'Error loading image!';
        header('Location: ../register.php');
    }
} else {
    $_SESSION['msg'] = 'Passwords do not match!';
    header('Location: ../register.php');
}