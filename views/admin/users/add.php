<?php include __DIR__.'/../../layouts/header.php'; ?>
<?php include __DIR__.'/../../../database/connection.php'; ?>
<?php include __DIR__.'/../../../classes/User.php'; ?>
<?php 
session_start();
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1){
    header("Location: /views/auth/login.php");
    exit;
}
if(isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['role']) && isset($_POST['password'])){
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $user = new User($password, $username, $conn);
    if($user->register($fullname, $role)){
        header("Location: /views/admin/dashboard.php");
        exit;
    } else {
        echo "Failed to add user";
    }
}

?>
<h2>Add User</h2>

<form method="post" action="">
    <!-- TODO: Add input fields for name and email -->
    <div class="form-group">
        <label for="fullname">fullname:</label>
        <input type="text" class="form-control" name="fullname" id="fullname" required>
    </div>
    <div class="form-group">
        <label for="username">username:</label>
        <input type="username" class="form-control" name="username" id="username" required>
    </div>
    <div class="form-group">
        <label for="password">password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <div class="form-group">
       <select name="role" id="role">
        <option value="2" default>User</option>
        <option value="1">Admin</option>
       </select>
    </div>

    <!-- TODO: Add submit button -->
    <button type="submit" class="btn btn-primary">Add Employee</button>
</form>

<?php include __DIR__.'/../../layouts/footer.php'; ?>
