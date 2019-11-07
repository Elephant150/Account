<?php
session_start();
require_once "connect.php";

$username = trim($_POST['username']);
$password = MD5(trim($_POST['password']));

//    -----------------------
$check_user = $dbh->prepare("SELECT * FROM `users` WHERE `login` = '$username' AND `password` = '$password'");
$check_user->execute();

if ($check_user->rowCount() > 0){
    $user = $check_user->fetchAll(PDO::FETCH_ASSOC);

//    echo "<pre>";
//    print_r($user);
//    echo "</pre>";
    foreach ($user as $item) {
        $id = $item['id'] . '<br>';
        $_SESSION['full_name'] = $item['full_name'].'<br>';
        $_SESSION['user'] = $item['login'].'<br>';
        $_SESSION['email'] = $item['email'].'<br>';
        $_SESSION['picture'] = $item['picture'];
    }
//    echo $full_name . $login . $email ;
//    echo "<img src='../$picture' width='300'>";
//    $_SESSION['user'] = $login;
//    $_SESSION['full_name'] = $full_name;
//    $_SESSION['email'] = $email;
//    $_SESSION['picture'] = $picture;
    header('Location: ../profile.php');

} else {
    $_SESSION['msg'] = 'Invalid login or password!';
    header('Location: ../index.php');
}
//    -----------------------