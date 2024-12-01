<?php
// Include database connection file
include_once "db_connect.php";

// Start session
session_start();

// Process child connection based on user type
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $child_username = $_POST["child_username"];
    $user_type = $_POST["user_type"];

    // Check if user type is parent or counselor
    if ($user_type == "parent") {
        // Retrieve parent ID from session
        $parent_id = $_SESSION["parent_id"];

        // Check if the child username exists in the students table
        $sql_check_child = "SELECT * FROM students WHERE username = '$child_username'";
        $result_check_child = $conn->query($sql_check_child);

        if ($result_check_child->num_rows > 0) {
            // Child username exists, insert parent-child relationship into parent_child_relationships table
            $sql_insert_relationship = "INSERT INTO parent_child_relationships(parent_id, child_username) VALUES ('$parent_id', '$child_username')";
            if ($conn->query($sql_insert_relationship) === TRUE) {
                // Connection successful, redirect to parent login page with a success message
                header("Location: login(Parent).html?success=connection_successful");
                exit();
            } else {
                // Error connecting child, redirect back to specify child username page with error message
                header("Location: specify_child_username.html?user_type=parent&error=connection_failed");
                exit();
            }
        } else {
            // Child username not found, redirect back to specify child username page with error message
            header("Location: specify_child_username.html?user_type=parent&error=child_not_registered");
            exit();
        }
    } else if ($user_type == "counselor") {
        // Retrieve counselor ID from session
        $counselor_id = $_SESSION["counselor_id"];

        // Check if the child username exists in the students table
        $sql_check_child = "SELECT * FROM students WHERE username = '$child_username'";
        $result_check_child = $conn->query($sql_check_child);

        if ($result_check_child->num_rows > 0) {
            // Child username exists, insert counselor-child relationship into counselor_child_relationships table
            $sql_insert_relationship = "INSERT INTO counselor_child_relationships(counselor_id, child_username) VALUES ('$counselor_id', '$child_username')";
            if ($conn->query($sql_insert_relationship) === TRUE) {
                // Connection successful, redirect to counselor login page with a success message
                header("Location: login(Counselor).html?success=connection_successful");
                exit();
            } else {
                // Error connecting child, redirect back to specify child username page with error message
                header("Location: specify_child_username.html?user_type=counselor&error=connection_failed");
                exit();
            }
        } else {
            // Child username not found, redirect back to specify child username page with error message
            header("Location: specify_child_username.html?user_type=counselor&error=child_not_registered");
            exit();
        }
    } else {
        // Invalid user type, redirect to homepage
        header("Location: homepage.html");
        exit();
    }
} else {
    // Redirect to homepage if accessed without form submission
    header("Location: homepage.html");
    exit();
}
?>
