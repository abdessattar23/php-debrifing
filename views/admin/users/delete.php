<?php include __DIR__.'/../../../database/connection.php'; ?>
<?php 
session_start();
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1){
    header("Location: /views/auth/login.php");
    exit;
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    try {
        $stmt = $conn->prepare("DELETE FROM User WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: /views/admin/dashboard.php");
        exit;
    } catch (PDOException $e) {
        throw new Exception("Failed to get user: " . $e->getMessage());
    }
}else{
    echo "No user id provided";
    exit;
}

?>