<?php
session_start();
if (!isset($_SESSION['user'])){
    header('Location: index.php');
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

<div class="info">
<?php if (isset($_SESSION['user'])) {?>
    <img src="<?= $_SESSION['picture'] ?>" width="300">
    <h2><?= $_SESSION['user'] ?></h2>
    <h3><?= $_SESSION['full_name'] ?></h3>
    <a href="#"><?= $_SESSION['email'] ?></a>
    <a href="vendor/logout.php" class="logout">Logout</a>
<?php
}else{
    echo '';
}
    ?>

</div>
</body>
</html>