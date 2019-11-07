<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['full_name']);
unset($_SESSION['email']);
unset($_SESSION['picture']);
header('Location: ../index.php');