<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
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
            display: flex;
            flex-direction: column;
            margin:15%;
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
            max-width: 500  px;
            background-color: #fff;
            padding: 90px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
            margin-right: 60px;
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
        /* Add the following styles to your existing <style> block */

/* Styles for the registered students table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #4169e2;
    color: #fff;
}

/* Apply alternating background color to table rows */
tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Add some spacing and styling to the registration message */
#mainContent p {
    margin: 20px 0;
    font-size: 16px;
    color: #333;
}


    </style>
</head>
<body>
    <section>
        <nav>
            <ul>
                <li><a href="#" id="addStudent">Add New Student</a></li>
                <li><a href="#" id="insertResult">Insert New Result</a></li>
                <li><a href="#" id="registeredStudents">Registered Students</a></li>
                <li><a href="#" id="allResults">All Student Results</a></li>
            </ul>
        </nav>
        <main id="mainContent">
            <h2>Welcome to Student Management System</h2>
            <!-- Right side content will be dynamically updated here -->
        </main>
    </section>

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

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: student_management.php");
    }

    if (isset($_POST['add_student'])) {
        $department_name = $_POST['departmentName'];
        $course_name = $_POST['courseName'];
        $name = $_POST['studentName'];
        $id_no = $_POST['idNo'];

        $stmt = $conn->prepare("INSERT INTO students (name, department_name, course_name, id_no) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $department_name, $course_name, $id_no);

        if ($stmt->execute()) {
            echo "New student added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    if (isset($_POST['insert_result'])) {
        $student_id = $_POST['idNoResult'];
        $physics = $_POST['physics'];
        $chemistry = $_POST['chemistry'];
        $biology = $_POST['biology'];

        $stmt = $conn->prepare("INSERT INTO results (student_id, physics, chemistry, biology) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $student_id, $physics, $chemistry, $biology);

        if ($stmt->execute()) {
            echo "New result added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Update student details
if (isset($_POST['update_student'])) {
    $student_id = $_POST['studentId'];
    $new_name = $_POST['newName'];
    $new_class = $_POST['newClass'];

    // Prepare and bind the UPDATE statement
    $stmt = $conn->prepare("UPDATE students SET name = ?, department_name = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_name, $new_class, $student_id);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        $response = "success";
    } else {
        $response = "error: " . $stmt->error;
    }

    $stmt->close();

    // Send the response back to the JavaScript code
    echo $response;
    exit;
}

    ?>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addStudent = document.getElementById('addStudent');
            const insertResult = document.getElementById('insertResult');
            const registeredStudents = document.getElementById('registeredStudents');
            const allResults = document.getElementById('allResults');
            const mainContent = document.getElementById('mainContent');

            addStudent.addEventListener('click', () => {
                mainContent.innerHTML = `
                    <h2>Add New Student</h2>
                    <form method="post" action="">
                        <label for="departmentName">Department Name:</label>
                        <input type="text" id="departmentName" name="departmentName" required>
                        <label for="courseName">Course Name:</label>
                        <input type="text" id="courseName" name="courseName" required>
                        <label for="studentName">Student Name:</label>
                        <input type="text" id="studentName" name="studentName" required>
                        <label for="idNo">ID Number:</label>
                        <input type="text" id="idNo" name="idNo" required>
                        <button type="submit" name="add_student">Add Student</button>
                    </form>
                `;
            });

            insertResult.addEventListener('click', () => {
                mainContent.innerHTML = `
                    <h2>Insert New Result</h2>
                    <form method="post" action="">
                        <label for="idNoResult">ID Number:</label>
                        <input type="text" id="idNoResult" name="idNoResult" required>
                        <label for="physics">Physics:</label>
                        <input type="text" id="physics" name="physics" required>
                        <label for="chemistry">Chemistry:</label>
                        <input type="text" id="chemistry" name="chemistry" required>
                        <label for="biology">Biology:</label>
                        <input type="text" id="biology" name="biology" required>
                        <button type="submit" name="insert_result">Insert Result</button>
                    </form>
                `;
            });

            registeredStudents.addEventListener('click', () => {
    // Make an AJAX request to fetch registered students
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const students = JSON.parse(xhr.responseText);
                displayRegisteredStudents(students);
            } else {
                alert("Error: Unable to fetch registered students. Status code: " + xhr.status);
            }
        }
    };

    xhr.open("GET", "fetch_registered_students.php", true);
    xhr.send();
});
function displayRegisteredStudents(students) {
    // Create HTML table to display registered students
    let html = "<h2>Registered Students</h2>";

    if (students.length > 0) {
        // Start the table and define table headers
        html += "<table border='1'>";
        html += "<tr><th>Name</th><th>Department</th><th>Course</th><th>ID Number</th></tr>";

        // Iterate over each student and create a table row for each
        students.forEach((student) => {
            html += `<tr>`;
            html += `<td>${student.name}</td>`;
            html += `<td>${student.department_name}</td>`;
            html += `<td>${student.course_name}</td>`;
            html += `<td>${student.id_no}</td>`;
            html += `</tr>`;
        });

        // Close the table
        html += "</table>";
    } else {
        // Display a message if no registered students are found
        html += "<p>No registered students found.</p>";
    }

    // Update the mainContent with the generated HTML
    mainContent.innerHTML = html;
}



allResults.addEventListener('click', () => {
    // Make an AJAX request to fetch all student results
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const results = JSON.parse(xhr.responseText);
                displayAllStudentResults(results);
            } else {
                alert("Error: Unable to fetch all student results. Status code: " + xhr.status);
            }
        }
    };

    xhr.open("GET", "fetch_all_student_results.php", true); // Adjust the URL to your PHP file
    xhr.send();
});

function displayAllStudentResults(results) {
    // Create HTML to display all student results
    let html = "<h2>All Student Results</h2><ul>";

    results.forEach((result) => {
        html += `<li>${result.student_id} - Physics: ${result.physics}, Chemistry: ${result.chemistry}, Biology: ${result.biology}</li>`;
    });

    html += "</ul>";

    // Update the mainContent with the generated HTML
    mainContent.innerHTML = html;
}

        });


    document.addEventListener('DOMContentLoaded', () => {
    const addStudent = document.getElementById('addStudent');
    const insertResult = document.getElementById('insertResult');
    const registeredStudents = document.getElementById('registeredStudents');
    const allResults = document.getElementById('allResults');
    const mainContent = document.getElementById('mainContent');


    allResults.addEventListener('click', () => {
        // Implement the logic to fetch and display all student results
        const xhr = new XMLHttpRequest();

        xhr.open("GET", "fetch_all_student_results.php", true);

        xhr.onload = function () {
            if (xhr.status == 200) {
                const results = JSON.parse(xhr.responseText);
                displayAllStudentResults(results);
            } else {
                console.error("Error fetching student results. Status code: " + xhr.status);
            }
        };

        xhr.send();
    });

    function displayAllStudentResults(results) {
    // Create HTML table to display all student results
    let html = "<h2>All Student Results</h2><table border='1'><tr><th>Student ID</th><th>Physics</th><th>Chemistry</th><th>Biology</th></tr>";

    results.forEach((result) => {
        html += `<tr><td>${result.student_id}</td><td>${result.physics}</td><td>${result.chemistry}</td><td>${result.biology}</td></tr>`;
    });

    html += "</table>";

    // Update the mainContent with the generated HTML
    mainContent.innerHTML = html;
}
});



    </script>
</body>
</html>