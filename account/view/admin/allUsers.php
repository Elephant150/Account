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
    require_once "../../config/allUsersConfig.php";

    foreach ($results as $result) {
        $id = $result['id'];
        $login = $result['login'];
        $password = $result['password'];
        $blockage = $result['blockage'];
        ?>

        <h2>Id: <?= $id ?></h2><br>
        <h2>Login: <?= $login ?> </h2><br>
        <h2>Password: <?= $password ?> </h2><br>
        <ul style="list-style-type: none; padding-right: 20px">
            <li style="display: inline-block;  padding-right: 20px"><a
                        href="../../config/allUsersConfig.php?del=<?= $id; ?>">Delete</a></li>
            <li style="display: inline-block;  padding-right: 20px"><a
                        href="../../config/allUsersConfig.php?block=<?= $id; ?>">Block</a></li>
            <li style="display: inline-block;  padding-right: 20px"><a
                        href="../../config/allUsersConfig.php?unblock=<?= $id; ?>">Unblock</a></li>

            <li style="display: inline-block;  padding-right: 20px">
                <form action='../../config/allUsersConfig.php' method='post'>
                    <input type="checkbox"<?= $blockage ? ' checked disabled' : '' ?>>
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo '<p class="msg">' . $_SESSION['msg'] . '</p>';
                    }
                    unset($_SESSION['msg']);
                    ?>
                </form>
            </li>
        </ul>
        <?php
        echo '<hr>';
    }

    ?>
</div>
</body>