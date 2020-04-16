<?php
require_once "../../config/connect.php";
$edit = $dbh->prepare("select * from `users`");
$edit->execute();
$results = $edit->fetchAll();

foreach ($results as $result) {
    $id = $result['id'];
    $login = $result['login'];
    $pass = $result['password'];
}
?>

<nav>
    <ul class="topmenu">
        <li><a href="profile.php">Home</a></li>
        <li><a href="changeUserPassword.php" >Change password</a></li>
        <li><a href="../../config/logout.php" class="logout">Logout</a></li>
    </ul>
</nav>

