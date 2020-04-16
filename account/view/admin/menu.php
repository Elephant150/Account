<?php
require_once "../../config/connect.php";
$edit = $dbh->prepare("select * from `admins`");
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
        <li><a href="admin.php">Home</a></li>
        <li><a href="allAdmins.php" >all admins</a></li>
        <li><a href="allUsers.php" >all users</a></li>
        <li><a href="#">Settings<span class="fa fa-angle-down"></span></a>
            <ul class="submenu">
                <li><a href="changePassword.php?edit=<?= $_SESSION['admin_id'] ?>">Change password</a>
                </li>
                <li><a href="registerNewAdmin.php">Add new admin<span class="fa fa-angle-down"></span></a>
                </li>
                <li><a href="">Reserved</a>
                    <ul class="submenu">
                        <li><a href="reserveLogin.php">Reserve login</a></li>
                        <li><a href="reservedList.php">Reserved list</a></li>
                    </ul>
                </li>

            </ul>
        </li>
        <li><a href="../../config/logout.php" class="logout">Logout</a></li>
    </ul>
</nav>



