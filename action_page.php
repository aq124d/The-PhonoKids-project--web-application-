<?php
// Include your database connection code here

// Process sign-up form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type']; // Parent or counselor
    $child_username = $_POST['child_username'];

    // Retrieve child's ID based on username
    $child_query = "SELECT id FROM students WHERE username = '$child_username'";
    $child_result = $conn->query($child_query);
    if ($child_result->num_rows > 0) {
        $child_row = $child_result->fetch_assoc();
        $child_id = $child_row['id'];

        // Insert parent-child or counselor-child relationship into the appropriate table
        if ($user_type == 'parent') {
            $relationship_query = "INSERT INTO parent_child_relationship (parent_id, child_id) VALUES ($user_id, $child_id)";
        } elseif ($user_type == 'counselor') {
            $relationship_query = "INSERT INTO counselor_child_relationship (counselor_id, child_id) VALUES ($user_id, $child_id)";
        }

        if ($conn->query($relationship_query) === TRUE) {
            echo "Parent-child or counselor-child relationship created successfully.";
        } else {
            echo "Error: " . $relationship_query . "<br>" . $conn->error;
        }
    } else {
        echo "Child not found.";
    }
}
?>
