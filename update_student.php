<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_result";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['name']) && isset($_POST['class'])) {
    $name = $_POST['name'];
    $class = $_POST['class'];

    // Assuming you have a 'students' table with columns 'name' and 'department_name'
    $stmt = $conn->prepare("UPDATE students SET department_name = ? WHERE name = ?");
    $stmt->bind_param("ss", $class, $name);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "error: Missing parameters";
}

$conn->close();
?>
