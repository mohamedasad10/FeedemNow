<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="style.css">

    <style>
      
    /* FOOTER DETAILS */  
    html, body {
    height: 100%; /* Ensure the body and html cover the full height of the viewport */
    margin: 0; /* Remove default margin */
    }

    .container {
        min-height: 100vh; 
        display: flex;
        flex-direction: column;
    }

    .listProduct {
        flex-grow: 1; 
        padding-bottom: 50px; 
    }

    footer {
        background-color: #ac301a; /* Red background */
        color: #FFFFFF; /* White text */
        padding: 40px 20px;
        text-align: center;
        font-size: 14px;
        font-weight: 400;
        border-top: 2px solid #444;
        width: 100%; 
        box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.2);
        margin-top: auto; /* Push the footer to the bottom */
    }

    footer p {
        margin: 0;
        letter-spacing: 1px;
        font-size: 15px; 
    }

    footer p:hover {
        color: #FFD700; 
        transition: color 0.3s ease;
    }

    footer a {
        color: #FFD700; 
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }


    </style>
</head>
<body>
    
    <div class="container">
        <header class="menu-bar">           
            <img class="menu-logo" src="images/feedemnow-logo.png" alt="FeedemNow">
            <ul class="menu">
                <li><a href="index.html">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="profile.php" class="user" id="userNameLink">Name Surname</a></li>
            </ul>

            <div class="iconCart">
                <img src="images/cart-icon.png">
                <div class="totalQuantity">0</div>
            </div>
        </header>

        <nav class="menu-filter">
            <ul>
                <li><a href="#" onclick="filterByCategory('all')">All</a></li>
                <li><a href="#" onclick="filterByCategory('light eats')">Popular</a></li>
                <li><a href="#" onclick="filterByCategory('sandwiches')">Sandwiches</a></li>
                <li><a href="#" onclick="filterByCategory('toasties')">Toasties</a></li>
                <li><a href="#" onclick="filterByCategory('gatsbys')">Gatsbys</a></li>
                <li><a href="#" onclick="filterByCategory('savoury snacks')">Snacks</a></li>
                <li><a href="#" onclick="filterByCategory('confectionary')">Confectionary</a></li>
                <li><a href="#" onclick="filterByCategory('sweet treats')">Treats</a></li>
                <li><a href="#" onclick="filterByCategory('cold beverages')">Beverages</a></li>
            </ul>
        </nav>

        <div class="listProduct"> <br> <br>
            
        </div>
    </div>

    <div class="cart">
        <h2>My Cart</h2>
        <div class="listCart"></div>

        <div class="buttons">
            <div class="close">CLOSE</div>
            <div class="checkout">
                <a href="checkout.html">CHECKOUT</a>
            </div>
        </div>
    </div>

    <script src="app.js"></script>

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
  $stmt = $conn->prepare("SELECT first_name, last_name FROM logins WHERE student_number = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $user_name = $row['first_name'] . ' ' . $row['last_name'];
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
    // Function to update the user name link with the user's full name
    function updateUserNameLink() {
      document.getElementById('userNameLink').innerText = "<?php echo htmlspecialchars($user_name); ?>";
    }

    // Call the updateUserNameLink function when the page loads
    window.onload = updateUserNameLink;
  </script>

    <footer>
        <p>&copy; 2024 Feedem. All Rights Reserved.</p>
        
    </footer>

    
</body>

</html>