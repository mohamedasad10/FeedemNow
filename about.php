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
    $user_name = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
} else {
    // If user details are not found, redirect to login page
    header("Location: login.html");
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>About Us | Feedem</title>
    <style>
        body {
            background-color: #fff;
            color: #000;
            line-height: 1.6;
        }
        .about-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        h1 {
            font-size: 36px;
            font-weight: bold;
            color: #8E200C; /* Main color */
            text-align: center;
        }
        h2 {
            font-size: 28px;
            font-weight: bold;
            color: #AC311A; /* Secondary color */
            margin-top: 30px;
        }
        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        /*Top Header*/
        .header {
        display: flex;
        justify-content: flex-start; 
        align-items: center; 
        padding: 10px 20px;
        background-color: #fff;
        gap: 40px; 
        }

        .logo {
            height: 100px;
            width: auto; 
        }

        .menu-filter ul {
            list-style-type: none; 
            margin: 0;
            padding: 0;
            display: flex; 
            gap: 20px; 
        }

        .menu-filter li {
            font-size: 18px;
        }

        .menu-filter a {
            text-decoration: none; 
            color: #212020;
            font-weight: bold;
        }

        .menu-filter a:hover {
            color: #AC311A; 
        }

        /* Our story */
        .story-container {
            display: flex;
            align-items: center;
            gap: 20px; 
            margin-bottom: 20px;
        }

        .staff-image {
            max-width: 50%; 
            height: auto; 
        }

        .story-container p {
            max-width: 50%; 
            font-size: 14px;
        }


        /*Core Values Image*/
        .core-values {
        display: block;
        margin: 0 auto;
        }

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
            margin-top: auto; 
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
        /********************Footer Details End Here*****************************/
    </style>
</head>

<body>

    <header class="menu-bar">           
        <img class="menu-logo" src="images/feedemnow-logo.png" alt="FeedemNow">
        <ul class="menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="profile.php" class="user" id="userNameLink">Name Surname</a></li>
        </ul>
    </header>
    

<div class="about-container">
    <h1>About Us</h1>
    <p>Established in 1975, Feedem is a large contract catering company in South Africa which
       manages in excess of 319 sites and employs more than 5 500 people ranging from dieticians,
       chefs and human capital specialists to hygiene experts.</p>
    
       <h2>Our Story</h2>
       <div class="story-container">
           <img class="staff-image" src="./images/feedemStaff.jpg" alt="Description of image">
           <p>We provide a wide range of catering and associated services to clients in all industries.
              Outsourcing your catering services to us will allow you to focus on your core business while
              benefiting from our expertise. This will improve your economies of scale, infrastructure, and
              ability to add instant capacity to your organization. From executive dining to express meals,
              big events to intimate functions, corporate catering to need-specific nourishment – we do it all.
              We combine the finest quality products with the freshest ingredients. We also add our attention
              to detail, texture, style, and taste to turn eating into a special event. We customize our
              catering and services according to your needs. Our services are offered with confidence as everything
              we do is underpinned by an ethical code and full compliance with all the relevant industry standards
              and regulations. We have a country-wide footprint with our head office in Johannesburg, and regional offices
              in Cape Town, Durban, George, Worcester, Port Elizabeth, Rustenburg, Kimberley, and Bloemfontein.</p>
       </div>
       

    <h2>Our Values</h2>
    <img class="core-values" src="./images/feedemCoreValues.jpg" alt="Description of image" width="800" height="700">
    
    
</div>

<script>
  // Function to update the user name link with the user's full name
  function updateUserNameLink() {
    document.getElementById('userNameLink').innerText = "<?php echo $user_name; ?>";
  }

  // Call the updateUserNameLink function when the page loads
  window.onload = updateUserNameLink;
</script>

<footer>
    <p>&copy; 2024 Feedem. All Rights Reserved.</p>
    <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>About Us | Feedem</title>
    <style>
        body {
            background-color: #fff;
            color: #000;
            line-height: 1.6;
        }
        .about-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        h1 {
            font-size: 36px;
            font-weight: bold;
            color: #8E200C; /* Main color */
            text-align: center;
        }
        h2 {
            font-size: 28px;
            font-weight: bold;
            color: #AC311A; /* Secondary color */
            margin-top: 30px;
        }
        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        /*Top Header*/
        .header {
        display: flex;
        justify-content: flex-start; 
        align-items: center; 
        padding: 10px 20px;
        background-color: #fff;
        gap: 40px; 
        }

        .logo {
            height: 100px;
            width: auto; 
        }

        .menu-filter ul {
            list-style-type: none; 
            margin: 0;
            padding: 0;
            display: flex; 
            gap: 20px; 
        }

        .menu-filter li {
            font-size: 18px;
        }

        .menu-filter a {
            text-decoration: none; 
            color: #212020;
            font-weight: bold;
        }

        .menu-filter a:hover {
            color: #AC311A; 
        }

        /* Our story */
        .story-container {
            display: flex;
            align-items: center;
            gap: 20px; 
            margin-bottom: 20px;
        }

        .staff-image {
            max-width: 50%; 
            height: auto; 
        }

        .story-container p {
            max-width: 50%; 
            font-size: 14px;
        }


        /*Core Values Image*/
        .core-values {
        display: block;
        margin: 0 auto;
        }

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
            margin-top: auto; 
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
        /********************Footer Details End Here*****************************/
    </style>
</head>

<body>

    <header class="menu-bar">           
        <img class="menu-logo" src="images/feedemnow-logo.png" alt="FeedemNow">
        <ul class="menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="profile.php" class="user" id="userNameLink">Name Surname</a></li>
        </ul>
    </header>
    

<div class="about-container">
    <h1>About Us</h1>
    <p>Established in 1975, Feedem is a large contract catering company in South Africa which
       manages in excess of 319 sites and employs more than 5 500 people ranging from dieticians,
       chefs and human capital specialists to hygiene experts.</p>
    
       <h2>Our Story</h2>
       <div class="story-container">
           <img class="staff-image" src="./images/feedemStaff.jpg" alt="Description of image">
           <p>We provide a wide range of catering and associated services to clients in all industries.
              Outsourcing your catering services to us will allow you to focus on your core business while
              benefiting from our expertise. This will improve your economies of scale, infrastructure, and
              ability to add instant capacity to your organization. From executive dining to express meals,
              big events to intimate functions, corporate catering to need-specific nourishment – we do it all.
              We combine the finest quality products with the freshest ingredients. We also add our attention
              to detail, texture, style, and taste to turn eating into a special event. We customize our
              catering and services according to your needs. Our services are offered with confidence as everything
              we do is underpinned by an ethical code and full compliance with all the relevant industry standards
              and regulations. We have a country-wide footprint with our head office in Johannesburg, and regional offices
              in Cape Town, Durban, George, Worcester, Port Elizabeth, Rustenburg, Kimberley, and Bloemfontein.</p>
       </div>
       

    <h2>Our Values</h2>
    <img class="core-values" src="./images/feedemCoreValues.jpg" alt="Description of image" width="800" height="700">
    
    
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
$stmt = $conn->prepare("SELECT first_name, last_name FROM logins WHERE student_number = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
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
    document.getElementById('userNameLink').innerText = "<?php echo $user_name; ?>";
  }

  // Call the updateUserNameLink function when the page loads
  window.onload = updateUserNameLink;
</script>

<footer>
    <p>&copy; 2024 Feedem. All Rights Reserved.</p>
    <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

</body>
</html> -->
