<?php
//    ----------------------- connection to the DataBase
$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$dbh = new PDO('mysql:host=tom;dbname=blog', 'root', '');
