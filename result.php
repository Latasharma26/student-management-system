<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit;
}

// Display result or any other content here
?>

<!DOCTYPE html>
<html>
<head>
    <title>Result Page</title>
    <!-- Include your CSS styles if needed -->
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <!-- Display other content based on the result -->
    <p>This is the result page.</p>

    <a href="logout.php">Logout</a> <!-- Provide a way to log out -->
</body>
</html>
