<?php
session_start();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authorization and registration</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="body_center">
<form action="../config/signin.php" method="post">
    <label>Login:</label>
    <input type="text" name="username" placeholder="Enter your login" required>
    <label>Password:</label>
    <input type="password" name="password" placeholder="Enter your password" required>
    <button type="submit">Login</button>
    <p>Create an account - <a href="register.php">Registration</a></p>
    <p>All info - <a href="info.php">Information</a></p>
    <?php
    //    ----------------- message box
    if (isset($_SESSION['msg'])) {
        echo '<p class="msg">' . $_SESSION['msg'] . '</p>';
    }
    unset($_SESSION['msg']);
    ?>
</form>
</body>
</html>