<?php



// Database configuration
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'situation';

// Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
