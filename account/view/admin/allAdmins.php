<?php
require_once "adminHeader.php";
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../index.php');
}
?>

<body class="body_center">

<div class="info">
    <?php require_once 'menu.php'; ?>
    <hr>

    <?php
    require_once '../../config/connect.php';
    $all_data = $dbh->prepare("select * from `admins` order by `id` desc");
    $all_data->execute();
    $results = $all_data->fetchAll();
    if (isset($_GET['del'])) {
        $del = $_GET['del'];
        $delete = $dbh->query("delete from admins where id=$del");
        header('location: allAdmins.php');
    }

    foreach ($results as $result) {
        echo '<h2>Id: ' . $result['id'] . '</h2><br>';
        echo '<h2>Login: ' . $result['login'] . '</h2><br>';
        echo '<h2>Password: ' . $result['password'] . '</h2><br>';
        echo '<a href="?del=' . $result['id'] . '">Delete</a><br>';
        echo '<hr>';
    }
    ?>
</div>
</body>