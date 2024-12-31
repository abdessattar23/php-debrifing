<?php 

require_once __DIR__.'/../classes/User.php';
require_once __DIR__.'/../database/connection.php';
       
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = new User($password, $username, $conn);
    if($user->login()){
        if($user->isAdmin()){
            header("Location: /views/admin/dashboard.php");
            exit;
        } else {
            header("Location: /index.php");
            exit;
        }
    } else {
        header("Location: /views/auth/login.php");
        exit;
    }
}

?>