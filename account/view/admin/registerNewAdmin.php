<?php
require_once "adminHeader.php";
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../index.php');
}

?>


<body class="body_center">
<div class="info">
    <?php require_once "menu.php"; ?>
    <hr>
    <form action="../../config/addNewAdmin.php" method="post">
        <div class="mb-2">
            <input type="text" name="username" class="form-control" placeholder="Enter the admin login" required>
            <input type="text" name="password" class="form-control" placeholder="Enter the admin password" required>
            <input type="text" name="password_confirm" class="form-control" placeholder="Confirm the admin password"
                   required>
            <button type="submit" name="edit">Add</button>
        </div>
        <?php
        if (isset($_SESSION['msg'])) {
            echo '<p class="msg">' . $_SESSION['msg'] . '</p>';
        }
        unset($_SESSION['msg']);
        ?>
    </form>

</div>
</body>