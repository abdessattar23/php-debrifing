<?php include __DIR__.'/../layouts/header.php'; ?>
<?php 
session_start();
if(isset($_SESSION['user_role'])){
    switch ($_SESSION['user_role']) {
     case 1:
         header("Location: /views/admin/dashboard.php");
         break;
     
     case 2:
         header("Location: /index.php");
         break;
    }
 }
?>
<h2>Login</h2>
<!-- TODO: Add login form with input fields for username and password -->
<!-- Add Bootstrap form classes as needed -->
<form method="post" action="/handlers/login.php">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" id="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php include __DIR__.'/../layouts/footer.php'; ?>
