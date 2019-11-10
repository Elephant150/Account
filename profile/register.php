<?php
session_start();
require_once "vendor/Connect.php";
require_once "vendor/Signup.php";
//if (isset($_SESSION['user'])){
//    header('Location: profile.php');
//}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label>Full name:</label>
    <input type="text" name="full_name" placeholder="Enter your full name" >
    <label>Username:</label>
    <input type="text" name="username" placeholder="Enter your username" >
    <label>Email:</label>
    <input type="email" name="email" placeholder="Enter your email" >
    <label>Picture:</label>
    <input type="file" name="picture">
    <label>Password:</label>
    <input type="password" name="password" placeholder="Enter your password" required>
    <label>Confirm the password:</label>
    <input type="password" name="password_confirm" placeholder="Confirm your password" required>
    <button type="submit" name="login">Register</button>
    <p>Do you have an account? - <a href="index.php">Login</a></p>
    <?php
    if (isset($_POST['login'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
//        $picture = $_POST['picture'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $acc = new Signup($full_name, $username, $email, $password, $password_confirm);
        if ($acc->register()) {
            echo 'yes';
        } else {
            echo 'not';
        }
    }


    //    ----------------------- message box
    if (isset($_SESSION['message'])){
        echo '<p class="msg">' . $_SESSION['message'] . '</p>';
    }
    unset($_SESSION['message']);
    ?>
</form>
</body>
</html>