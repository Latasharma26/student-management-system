<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comments = $_POST['comments'];

    // Save data to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_result";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO contact_entries (first_name, last_name, email, phone, comments)
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$comments')";

    if ($conn->query($sql) === TRUE) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4169e2;
            padding: 20px;
            border-radius: 5px 5px 0 0;
        }

        header h1 {
            color: #fff;
            margin: 0;
            margin-left: 45%;
        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            text-align: center;
        }

        nav {
            background-color: #eee;
            padding: 10px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }

        nav ul li {
            margin: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: inline-block;
        }

        nav ul li a:hover {
            background-color: #3462ed;
            color: #fff;
        }

        main {
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }

        @media (max-width: 768px) {
            main {
                flex-direction: column;
            }
        }

        .left-section {
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
            margin-right: 20px;
        }

        .right-section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4169e2;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4169e1;
        }

        img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        address {
            margin-top: 20px;
            font-style: normal;
            color: black;
        }

        /* New CSS for Dynamic Content Section */
        .dynamic-content {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .dynamic-content .left-side {
            flex: 1;
            padding: 20px;
            background-color: #eee;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .dynamic-content .right-side {
            flex: 1;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
<h1>Contact Us</h1>
</header>
    <section>

        <div class="left-section">
            <form action="#" method="post">
                <h1>We're here to assist you. Reach out anytime!</h1>
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <textarea name="comments" placeholder="Questions or Comments" rows="4" required></textarea>
                <input type="submit" value="Submit">
            </form>
        </div>
        <div class="right-section">
            <img src="contact1.png" alt="College Logo">
            <address>
                Level 3, 1 Fake Street<br>
                Sydney, NSW 2000<br>
                Phone: +61 433 334 433<br>
                Email: info@college.edu.au
            </address>
        </div>
    </section>
</body>
</html>
