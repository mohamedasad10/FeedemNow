# Feedem Now

## Overview
Feedem Now is a web-based food ordering application that allows users to browse a menu, add items to their cart, and proceed to checkout🍕. The app uses PHP for backend functionality, MySQL for database management, and HTML, CSS, and JavaScript for the frontend.

This project was developed as part of a CSC312 Software Engineering group assignment.

## Features
- User authentication (Login & Signup)
- Menu display with categorized food items
- Add to cart functionality
- Checkout process
- User profile management

## Technologies Used
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Server:** XAMPP (Apache & MySQL)

## Installation Guide
### 1. Fork and Clone the Repository
First, fork the repository and clone it to your local machine.

### 2. Set Up XAMPP
- Open **XAMPP Control Panel**.
- Start **Apache** and **MySQL** servers.

### 3. Place Project Folder Inside `htdocs`
Move the `FeedemNowApp` folder into the following directory:
C:\xampp\htdocs\feedemnowApp

### 4. Import Database
- Open your web browser and go to:
http://localhost/phpmyadmin/index.php?route=/database/structure&db=feedem_usersdb

- Create a new database named `feedem_usersdb`.
- Import the provided `.sql` file into the database.

### 5. Run the Application
- Open a browser and go to:
http://localhost/feedemnowApp/index.html

*(Ensure that `FeedemNowApp` is the folder name inside `htdocs`)*

### 6. Open in VS Code with Live Server
- Open VS Code and navigate to `index.html`.
- Right-click and select **Open with Live Server**.
- If needed, manually enter the URL:
http://localhost/feedemnowApp/index.html



## Contribution Guidelines
If you'd like to contribute to Feedem Now:
1. Fork the repository.
2. Create a feature branch (`git checkout -b feature-branch`).
3. Commit your changes (`git commit -m "Added a new feature"`).
4. Push the changes (`git push origin feature-branch`).
5. Open a Pull Request.

## License
This project is licensed under the MIT License.

## Contact
For any issues or suggestions, feel free to open an issue on GitHub.
