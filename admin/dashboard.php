<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedem Dashboard</title>
</head>
<body>
    <div class="profile-container">
        <h2>Profile</h2>
        <br>
        <div class="profile-pic"></div>
        <p class="user-email" id="userName"></p>
        <p class="user-email" id="userEmail"></p>
        <span class="logout-btn" onclick="logout()" style="cursor:pointer">Log Out</span>
        <span class="logout-btn" style="margin-left: 20px"><a href="admin_signup.html">Add Admin User</a></span>
      </div>
    
      <?php
      // Include the database configuration file
      require_once '../backend/db/config.php';
    
      // Start the session
      session_start();
    
      // Check if the user is logged in
      if (!isset($_SESSION['user_id'])) {
          header("Location: login.html");
          exit();
      }
    
      // Fetch the user details from the database
      $user_id = $_SESSION['user_id'];
      $stmt = $conn->prepare("SELECT first_name, last_name, email FROM admin_logins WHERE id = ?");
      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $result = $stmt->get_result();
    
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $user_name = $row['first_name'] . ' ' . $row['last_name'];
          $user_email = $row['email'];
      } else {
          // If user details are not found, redirect to login page
          header("Location: login.html");
          exit();
      }
    
      // Close the statement and connection
      $stmt->close();
      $conn->close();
      ?>
    
      <script>
        // Function to update the profile page with user details
        function updateProfile() {
          document.getElementById('userName').innerText = "<?php echo htmlspecialchars($user_name); ?>";
          document.getElementById('userEmail').innerText = "<?php echo htmlspecialchars($user_email); ?>";
        }
    
        // Call the updateProfile function when the page loads
        window.onload = updateProfile;
    
        // Function to handle logout
        function logout() {
          // Redirect to the logout script
          window.location.href = '../backend/logout.php';
        }
      </script>
</body>
</html>