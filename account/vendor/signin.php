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

    foreach ($user as $item) {
        $full_name = $item['full_name'].'<br>';
        $login = $item['login'].'<br>';
        $email = $item['email'].'<br>';
        $picture = $item['picture'];
    }
    echo $full_name . $login . $email ;
    echo "<img src='../$picture' width='300'>";
//    $_SESSION['user'] = [
//        "id" => $user['id'],
//        "full_name" => $user['full_name'],
//        "email" => $user['email'],
//        "picture" => $user['picture']
//    ];
//    header('Location: ../profile.php');

} else {
    $_SESSION['msg'] = 'Invalid login or password!';
    header('Location: ../index.php');
}
//    -----------------------