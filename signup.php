<?php
include_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];
    $user_type = $_POST["user_type"];


     // Client-side password matching validation
     if ($password !== $confirm_password) {
        header("Location: signup.html?error=password_mismatch");
        exit();
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($user_type == "student") {
        // Insert into students table
        $sql_students = "INSERT INTO students (name, username, password, email) VALUES ('$name','$username', '$hashed_password', '$email')";
        if ($conn->query($sql_students) === TRUE) {
            header("Location: login(Student).html");
            exit();
        } else {
            header("Location: signup.html?error=registration_failed");
            exit();
        }
    }

        // Insert into counselors table
    else if($user_type == "counselor") {
        $sql_counselors = "INSERT INTO counselors (name, username, password, email) VALUES ('$name','$username', '$hashed_password', '$email')";
        if ($conn->query($sql_counselors) === TRUE) {
            header(("Location: specify_child_username.html?user_type=$user_type&username=$username"));
            exit();
        } else {
            header("Location: signup.html?error=registration_failed");
            exit();
        }
    }

     else if($user_type == "parent")  {  // Insert into parents table
        $sql_parents = "INSERT INTO parents (name, username, password, email) VALUES ('$name','$username', '$hashed_password', '$email')";
        if ($conn->query($sql_parents) === TRUE) {
            header(("Location: specify_child_username.html?user_type=$user_type&username=$username"));
            exit();
        } else {
            header("Location: signup.html?error=registration_failed");
            exit();
        }
    
    } else {
        header("Location: signup.html?error=invalid_user_type");
        exit();
    }
} else {
    header("Location: signup.html");
    exit();
}
?>
