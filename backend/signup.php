<?php
// Include the database configuration file
require_once 'db/config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $student_number = $_POST['student_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the form data
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.location.href='../signup.html';</script>";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert the new user
    $stmt = $conn->prepare("INSERT INTO logins (first_name, last_name, student_number, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $surname, $student_number, $email, $hashed_password);

    if ($stmt->execute()) {
        // Signup successful, redirect to the login page
        echo "<script>alert('Signup successful. Please log in.'); window.location.href='../login.html';</script>";
        exit();
    } else {
        // Signup failed, show an alert
        echo "<script>alert('Signup failed. Please try again.'); window.location.href='../signup.html';</script>";
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>