<?php
// Include the database configuration file
require_once 'db/config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the form data
    if ($password !== $confirm_password) {
        header("Location: ../admin/admin_signup.html?error=Passwords+do+not+match");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert the new admin user
    $stmt = $conn->prepare("INSERT INTO admin_logins (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);

    if ($stmt->execute()) {
        // Signup successful, redirect to admin dashboard page
        header("Location: ../admin/dashboard.php");
        exit();
    } else {
        // Signup failed, show an alert
        header("Location: ../admin/admin_signup.html?error=Signup+failed");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>