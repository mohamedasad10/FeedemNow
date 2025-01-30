<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <style>

    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .profile-container {
      background-color: white;
      padding: 20px;
      border: 2px solid rgba(37, 35, 35, 0.826);
      border-radius: 15px;
      width: 300px;
      text-align: left;
      box-shadow: 1px 10px 10px #00000045;
    }

    .profile-pic {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background-color: #ddd;
      display: inline-block;
      position:absolute;
      margin-bottom: 10px;
    }

    h2 {
      margin-top: 10px;
    }

    .user-email {
      color: black;
      font-size: 15px;
      font-weight: bold;
      display: flex;
      transform: translateX(110px) translateY(0px);
    }

    .logout-btn {
      margin-top: 20px;
      color: red;
      text-decoration: underline;
      cursor: pointer;
      display: inline-block;
      margin-bottom: 10px;
    }
  </style>

</head>
<!-- <body>

  <div class="profile-container">
    <h2>Profile</h2>
    <br>
    <div class="profile-pic"></div>
    <p class="user-email" id="userName"></p>
    <p class="user-email" id="userEmail"></p>
    <span class="logout-btn" onclick="logout()">Log Out</span>
  </div>

  <script>
    const userData = {
      name: "Name Surname",
      email: "abc123@gmail.com"
    };

    document.getElementById('userName').textContent = userData.name;
    document.getElementById('userEmail').textContent = userData.email;

    function logout() {
      alert('You have been logged out.');
      window.location.href = 'index.html'
    }
  </script>

</body> -->
<body>
  <div class="profile-container">
    <h2>Profile</h2>
    <br>
    <div class="profile-pic"></div>
    <p class="user-email" id="userName"></p>
    <p class="user-email" id="userEmail"></p>
    <span class="logout-btn" onclick="logout()">Log Out</span>
    <span class="logout-btn" style="margin-left: 20px"><a href="menu.php">Back to Menu</a></span>
  </div>

  <?php
  // Include the database configuration file
  require_once 'backend/db/config.php';

  // Start the session
  session_start();

  // Check if the user is logged in
  if (!isset($_SESSION['user_id'])) {
      header("Location: login.html");
      exit();
  }

  // Fetch the user details from the database
  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT first_name, last_name, email FROM logins WHERE student_number = ?");
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
      window.location.href = 'backend/logout.php';
    }
  </script>
</body>
</html>
