<?php include __DIR__.'/../../layouts/header.php'; ?>
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
        $stmt = $conn->prepare("SELECT * FROM User WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
    } catch (PDOException $e) {
        throw new Exception("Failed to get user: " . $e->getMessage());
    }
}else{
    echo "No user id provided";
    exit;
}

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    try {
        $stmt = $conn->prepare("UPDATE User SET fullname = ?, username = ?, role_id = ? WHERE id = ?");
        $stmt->execute([$fullname, $username, $role, $id]);
        header("Location: /views/admin/dashboard.php");
        exit;
    } catch (PDOException $e) {
        throw new Exception("Failed to update user: " . $e->getMessage());
    }
}

?>
<h2>Edit User</h2>

<form method="post" action="">
    <!-- TODO: Add input fields for name and email -->
    <div class="form-group">
        <label for="fullname">fullname:</label>
        <input type="text" class="form-control" name="fullname" id="fullname" value="<?= $user['fullname'] ?>" required>
    </div>
    <div class="form-group">
        <label for="username">username:</label>
        <input type="username" class="form-control" name="username" id="username" value="<?= $user['username'] ?>" required>
    </div>

    <div class="form-group">
       <select name="role" id="role">
        <option value="<?= $user['role_id'] ?>" default>Default <?php echo $user['role_id'] == 1 ? 'Admin' : 'User'; ?></option>
        <option value="1">Admin</option>
        <option value="2">User</option>
       </select>
    </div>
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <button type="submit" class="btn btn-primary">Edit Employee</button>
</form>

<?php include __DIR__.'/../../layouts/footer.php'; ?>
