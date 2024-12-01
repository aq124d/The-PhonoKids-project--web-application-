<?php
// Include the database connection file
include_once "db_connect.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL query to fetch student data based on the provided username
    $sql = "SELECT * FROM students WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Student exists, verify the password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, redirect to the student dashboard
            header("Location: dashboardkids.html");
            exit();
        } else {
            // Password is incorrect, redirect back to the login page with error message
            header("Location: login(Student).html?error=incorrect_password");
            exit();
        }
    } else {
        // Student doesn't exist, redirect back to the login page with error message
        header("Location: login(Student).html?error=user_not_found");
        exit();
    }
} else {
    // Redirect to the homepage if accessed without form submission
    header("Location: homepage.html");
    exit();
}
?>
