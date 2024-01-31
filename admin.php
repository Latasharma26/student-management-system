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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin_users WHERE username = '$username' AND password = '$password'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = 'admin';
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $error_message = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style>
header {
    font-size: 2em;
    margin-bottom: 50px;
}

section {
    display: flex;
    justify-content: center;
    width: 100%;
}
h1{
    margin-left:50%;
}
form {
    display: flex;
    flex-direction: column;
    width: 40%;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 10px;
}

label {
    font-size: 1em;
    margin-bottom: 8px;
    color: black;
}

input {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: rgb(27, 80, 212);
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color:  #3462ed;
}

img {
    width: 50%;
    height: auto;
    border-radius: 8px;
    margin-right: 20px;
}
</style>
<body>
<header>Admin Login</header>
<section>
    <img src="admin1.png" alt="Admin Image">
    <form action="student_management.php" method="post">
        <h1>Login </h1>
        <label for="username">User ID:</label>
        <input type="text" id="username" name="username">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Login">
    </form>
</section>
</body>
</html>
