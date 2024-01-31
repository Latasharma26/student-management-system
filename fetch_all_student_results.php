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

$sql = "SELECT * FROM results";
$result = $conn->query($sql);

$results = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($results);
?>
