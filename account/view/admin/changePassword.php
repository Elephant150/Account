<?php
include 'adminHeader.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../view/index.php');
}
?>

<body class="body_center">
<div class="info">
    <?php require_once "menu.php"; ?>
    <hr>
    <form action="../../config/changePassConfig.php" method="post">
        <div class="mb-2">
            <input type="hidden" name="id" value="<?= $_SESSION['admin_id']; ?>"><br>
            <input type="text" name="old_password" class="form-control" placeholder="Enter your password" required>
            <input type="text" name="new_pass" class="form-control" placeholder="Enter your new password" required>
            <input type="text" name="new_pass_confirm" class="form-control" placeholder="Confirm your new password"
                   required>
            <button type="submit" name="edit">Change</button>
        </div>

        <?php
        if (isset($_SESSION['msg'])) {
            echo '<p class="msg">' . $_SESSION['msg'] . '</p>';
        }
        unset($_SESSION['msg']);
        ?>
    </form>
</div>
<!--</div>-->
</body>