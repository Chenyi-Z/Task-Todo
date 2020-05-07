<?php

$host = 'localhost';
$user = 'app_test_user';
$password = 'testPassword';
$db = 'task_management';
$port = 8889;

$link = mysqli_init();
$success = mysqli_real_connect(
    $link,
    $host,
    $user,
    $password,
    $db,
    $port
);

?>
