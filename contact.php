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
    <title>Contact Us | Feedem</title>
    <style>
        body {
            background-color: #fff;
            color: #000;
            line-height: 1.6;
        }
        .contact-container {
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

        /* Top Header */
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

        .inquiry-block {
            border: 1px solid #ccc; 
            border-radius: 8px; 
            padding: 20px; 
            margin-top: 3px; 
            background-color: #f9f9f9; 
        }

        .map-container {
            display: flex; 
            justify-content: space-between; 
            margin-top: 20px; 
            border: 1px solid #ccc; 
            border-radius: 8px; 
            overflow: hidden; 
        }

        .map-block {
            flex: 2; 
            height: 400px; 
        }

        .details {
            flex: 1;
            padding: 20px; 
            background-color: #f9f9f9; 
        }

        /* Email Address */
        .email {
            font-size: 20px;
            font-weight: bold;
            color: #8E200C; 
            padding: 10px;
            background-color: #f2f2f2; 
            border-radius: 4px; 
            display: inline-block; 
            margin: 10px 0; 
            transition: background-color 0.3s ease; 
        }

        .email:hover {
            background-color: #e0e0e0; 
            cursor: pointer; 
        }

        /* FOOTER DETAILS */  
        html, body {
        height: 100%; /* Ensure the body and html cover the full height of the viewport */
        margin: 0; /* Remove default margin */
        }

        .container {
            min-height: 100vh; /* Ensure the container takes at least 100% of the viewport height */
            display: flex;
            flex-direction: column;
        }

        .listProduct {
            flex-grow: 1; /* Allows the main content to grow and push the footer down */
            padding-bottom: 50px; /* Add space below the product list */
        }

        footer {
            background-color: #ac301a; /* Red background */
            color: #FFFFFF; /* White text */
            padding: 40px 20px;
            text-align: center;
            font-size: 14px;
            font-weight: 400;
            border-top: 2px solid #444;
            width: 100%; /* Make the footer full width */
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.2);
            margin-top: auto; /* Push the footer to the bottom */
        }

        footer p {
            margin: 0;
            letter-spacing: 1px;
            font-size: 15px; /* Slightly larger for better readability */
        }

        footer p:hover {
            color: #FFD700; /* Hover effect */
            transition: color 0.3s ease;
        }

        footer a {
            color: #FFD700; /* Highlight links with gold */
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

    <div class="contact-container">
        <h1>Contact Us</h1>
        <div class="inquiry-block">
            <h2>General Inquiries</h2>
            <h3>info@feedem.co.za</h3>
            
            <p>We invite you to contact us to discuss your catering, consulting, cleaning, facilities management, and related needs. 
                You are also most welcome to ask us for a quotation or presentation. We’re here to help.
                <hr>U is ook welkom om in Afrikaans met ons te kommunikeer. Tree gerus met ons in verbinding om
                u behoeftes ten opsigte van spysenieringsdienste, konsultasie, skoonmaak- en instandhoudingsdienste met ons te bespreek. 
                Of vra ons vir ’n kwotasie of aanbieding. Ons is hier om te help.
            </p>
        </div>

        <h2>Our Location</h2>
        <div class="map-container">
            <div class="map-block">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2607.782418367199!2d18.622511075711323!3d-33.9314809732026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcc500dd504ab3d%3A0xf2a89f43716d1d91!2sLife%20Sciences%20Building!5e1!3m2!1sen!2sza!4v1728565698187!5m2!1sen!2sza" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy"></iframe>
            </div>
            <div class="details">
                <h3>Feedem</h3>
                <p>Robert Sobukwe Rd, Bellville, Cape Town, 7535</p>
                <p>Life Science Building</p>
                <p>University of the Western Cape</p>
                <p>021 959 2675 / 9729</p>
                <p><span class="email">Contact: llambrecht@feedem.co.za</span></p>
            </div>
        </div>
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
    </footer>
</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>Contact Us | Feedem</title>
    <style>
        body {
            background-color: #fff;
            color: #000;
            line-height: 1.6;
        }
        .contact-container {
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

        /* Top Header */
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

        .inquiry-block {
            border: 1px solid #ccc; 
            border-radius: 8px; 
            padding: 20px; 
            margin-top: 3px; 
            background-color: #f9f9f9; 
        }

        .map-container {
            display: flex; 
            justify-content: space-between; 
            margin-top: 20px; 
            border: 1px solid #ccc; 
            border-radius: 8px; 
            overflow: hidden; 
        }

        .map-block {
            flex: 2; 
            height: 400px; 
        }

        .details {
            flex: 1;
            padding: 20px; 
            background-color: #f9f9f9; 
        }

        /* Email Address */
        .email {
            font-size: 20px;
            font-weight: bold;
            color: #8E200C; 
            padding: 10px;
            background-color: #f2f2f2; 
            border-radius: 4px; 
            display: inline-block; 
            margin: 10px 0; 
            transition: background-color 0.3s ease; 
        }

        .email:hover {
            background-color: #e0e0e0; 
            cursor: pointer; 
        }

        /* FOOTER DETAILS */  
        html, body {
        height: 100%; /* Ensure the body and html cover the full height of the viewport */
        margin: 0; /* Remove default margin */
        }

        .container {
            min-height: 100vh; /* Ensure the container takes at least 100% of the viewport height */
            display: flex;
            flex-direction: column;
        }

        .listProduct {
            flex-grow: 1; /* Allows the main content to grow and push the footer down */
            padding-bottom: 50px; /* Add space below the product list */
        }

        footer {
            background-color: #ac301a; /* Red background */
            color: #FFFFFF; /* White text */
            padding: 40px 20px;
            text-align: center;
            font-size: 14px;
            font-weight: 400;
            border-top: 2px solid #444;
            width: 100%; /* Make the footer full width */
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.2);
            margin-top: auto; /* Push the footer to the bottom */
        }

        footer p {
            margin: 0;
            letter-spacing: 1px;
            font-size: 15px; /* Slightly larger for better readability */
        }

        footer p:hover {
            color: #FFD700; /* Hover effect */
            transition: color 0.3s ease;
        }

        footer a {
            color: #FFD700; /* Highlight links with gold */
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

    <div class="contact-container">
        <h1>Contact Us</h1>
        <div class="inquiry-block">
            <h2>General Inquiries</h2>
            <h3>info@feedem.co.za</h3>
            
            <p>We invite you to contact us to discuss your catering, consulting, cleaning, facilities management, and related needs. 
                You are also most welcome to ask us for a quotation or presentation. We’re here to help.
                <hr>U is ook welkom om in Afrikaans met ons te kommunikeer. Tree gerus met ons in verbinding om
                u behoeftes ten opsigte van spysenieringsdienste, konsultasie, skoonmaak- en instandhoudingsdienste met ons te bespreek. 
                Of vra ons vir ’n kwotasie of aanbieding. Ons is hier om te help.
            </p>
        </div>

        <h2>Our Location</h2>
        <div class="map-container">
            <div class="map-block">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2607.782418367199!2d18.622511075711323!3d-33.9314809732026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcc500dd504ab3d%3A0xf2a89f43716d1d91!2sLife%20Sciences%20Building!5e1!3m2!1sen!2sza!4v1728565698187!5m2!1sen!2sza" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy"></iframe>
            </div>
            <div class="details">
                <h3>Feedem</h3>
                <p>Robert Sobukwe Rd, Bellville, Cape Town, 7535</p>
                <p>Life Science Building</p>
                <p>University of the Western Cape</p>
                <p>021 959 2675 / 9729</p>
                <p><span class="email">Contact: llambrecht@feedem.co.za</span></p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Feedem. All Rights Reserved.</p>
    </footer>
</body>
</html> -->
