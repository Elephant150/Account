<?php
require_once "adminHeader.php";
require_once '../../config/connect.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../index.php');
}
?>

<body class="body_center">
<div class="info">
    <?php require_once "menu.php"; ?>
    <hr>
    <form action="../../config/resLoginConfig.php" method="post">
        <div class="mb-2">
            <input type="text" name="login" class="form-control" placeholder="Reserve login" required>
            <button type="submit" name="reserve">Reserve</button>
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