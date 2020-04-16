<?php
session_start();
require_once "userHeader.php";
if ($_SESSION['chb']) {
    header('Location: ../index.php');
}
?>

<body class="body_center">
<div class="info">
    <?php require_once "users_menu.php";
    require_once "../../config/connect.php";
    $edit = $dbh->prepare("select * from `users`");
    $edit->execute();
    $results = $edit->fetchAll();

    foreach ($results as $result) {
        $date = $result['date'];
    }

    ?>
    <hr>
    <?php if (isset($_SESSION['user'])) { ?>
        <h2>Login: <?= $_SESSION['user'] ?></h2>
        <h2>Password: <?= $_SESSION['password'] ?></h2>
        <h2>Date of registration: <?= $date ?></h2>
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