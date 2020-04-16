<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['admin']);
unset($_SESSION['password']);
unset($_SESSION['admin_password']);
unset($_SESSION['admin_id']);
unset($_SESSION['user_id']);
unset($_SESSION['chb']);
header('Location: ../view/index.php');