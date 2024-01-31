<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'student') {
    header('Location: student_login.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_result";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM results";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Student Results</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- Include your CSS styling here -->
    <style>
        body {
            text-align: center;
            margin-top: 50px;
        }

        h1 {
            font-size: 2em;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>All Student Results</h1>

    <?php if ($result->num_rows > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>Result ID</th>
                    <th>Student ID</th>
                    <th>Physics</th>
                    <th>Chemistry</th>
                    <th>Biology</th>
                    <!-- Add other columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['result_id']; ?></td>
                        <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo $row['physics']; ?></td>
                        <td><?php echo $row['chemistry']; ?></td>
                        <td><?php echo $row['biology']; ?></td>
                        <!-- Add other columns as needed -->
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No results found.</p>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
