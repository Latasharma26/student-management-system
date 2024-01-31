
<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['user_type'])) {
    header('location: index.html');
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_result";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    // Some code here
}
?>
