<?php
session_start();
if (isset($_SESSION['user'])){
    header('Location: profile.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authorization and registration</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<form action="vendor/signin.php" method="post">
    <label>Login:</label>
    <input type="text" name="username" placeholder="Enter your login" required>
    <label>Password:</label>
    <input type="password" name="password" placeholder="Enter your password" required>
    <button type="submit">Login</button>
    <p>Create an account - <a href="register.php">Registration</a></p>
    <?php
//    ----------------- message box
    if (isset($_SESSION['msg'])){
        echo '<p class="msg">' . $_SESSION['msg'] . '</p>';
    }
    unset($_SESSION['msg']);
    ?>
</form>
</body>
</html>