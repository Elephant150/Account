<?php
session_start();
//require_once "vendor/signin.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authorization and registration</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?//= $full_name; ?>
<form>
    <img src="<?= $_SESSION['user']['picture']; ?>" width="100" alt="">
    <h2><?= $_SESSION['user']['full_name']; ?></h2>
    <a href="#"><?= $_SESSION['user']['email']; ?></a>
</form>
</body>
</html>