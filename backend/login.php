<?php
// Include the database configuration file
require_once 'db/config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user is an admin
    $stmt = $conn->prepare("SELECT id, password FROM admin_logins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row is returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password is correct, set the session and redirect to the dashboard
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_role'] = 'admin';
            header("Location: ../admin/dashboard.php");
            exit();
        } else {
            // Password is incorrect, show an alert
            echo "<script>alert('Incorrect email or password.'); window.location.href='../login.html';</script>";
            exit();
        }
    } else {
        // Email not found in admin_logins, check regular users
        $stmt = $conn->prepare("SELECT student_number, password FROM logins WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a row is returned
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Password is correct, set the session and redirect to the profile page
                session_start();
                $_SESSION['user_id'] = $row['student_number'];
                $_SESSION['user_role'] = 'user';
                header("Location: ../menu.php");
                exit();
            } else {
                // Password is incorrect, show an alert
                echo "<script>alert('Incorrect email or password.'); window.location.href='../login.html';</script>";
                exit();
            }
        } else {
            // Email not found, show an alert
            echo "<script>alert('Incorrect email or password.'); window.location.href='../login.html';</script>";
            exit();
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>