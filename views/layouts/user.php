<?php 
session_start();
if(!isset($_SESSION['user_role'])) {
    header("Location: /views/auth/login.php");
}
if($_SESSION['user_role'] == 1) {
    header("Location: /views/admin/dashboard.php");
    exit;
}
?>
<?php include __DIR__.'/../layouts/header.php'; ?>
<h1>Hello <?= $_SESSION['user_name'] ?></h1>
<?php include __DIR__.'/../layouts/footer.php'; ?>
