<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: profile.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="body_center">
<form action="../config/signup.php" method="post" >
    <label>Username:</label>
    <input type="text" name="username" placeholder="Enter your username">
    <label>Password:</label>
    <input type="password" name="password" placeholder="Enter your password" required>
    <label>Confirm the password:</label>
    <input type="password" name="password_confirm" placeholder="Confirm your password" required>
    <button type="submit">Login</button>
    <p>Do you have an account? - <a href="index.php">Login</a></p>
    <?php
    //    ----------------------- message box
    if (isset($_SESSION['msg'])) {
        echo '<p class="msg">' . $_SESSION['msg'] . '</p>';
    }
    unset($_SESSION['msg']);
    ?>
</form>
</body>
</html>