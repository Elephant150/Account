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
    <div style="margin-left: auto">
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

    </div>
    <hr>
    <?php if (isset($_SESSION['admin'])) { ?>
        <h2>Login: <?= $_SESSION['admin'] ?></h2>
        <h2>Password: <?= $_SESSION['admin_password'] ?></h2>
        <?php
        if (isset($_SESSION['msg'])) {
            echo '<p class="msg">' . $_SESSION['msg'] . '</p>';
        }
        unset($_SESSION['msg']);

    } else {
        echo '';
    }
    ?>

</div>
</body>