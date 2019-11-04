<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<form action="vendor/signup.php" method="post" enctype="multipart/form-data">
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
    <button type="submit">Login</button>
    <p>Do you have an account? - <a href="index.php">Login</a></p>
    <?php
    //    ----------------------- message box
    if ($_SESSION){
        echo '<p class="msg">' . $_SESSION['msg'] . '</p>';
    }
    unset($_SESSION['msg']);
    ?>
</form>
</body>
</html>