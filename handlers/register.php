<?php 

require_once __DIR__.'/../classes/User.php';
require_once __DIR__.'/../database/connection.php';

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['fullname'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $user = new User($password, $username, $conn);
    if($user->register($fullname, 1)){
        header("Location: /views/auth/login.php");
        exit;
    } else {
        header("Location: /views/auth/register.php");
        exit;
    }
}

?>