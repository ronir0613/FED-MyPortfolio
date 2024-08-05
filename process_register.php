<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "portfolio"; 
// $servername = "sql213.infinityfree.com";
// $username = "if0_36985874"; 
// $password = "DzaCI7nPzhLfkj"; 
// $dbname = "if0_36985874_portfolio"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $nameRegex = "/^[A-Za-z]+$/";
    $usernameRegex = "/^[A-Za-z0-9]{8}$/";
    $passwordRegex = "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^\&*\)\(+=._-]).{8,}$/";

    if (!preg_match($nameRegex, $firstname)) {
        echo "First name should only consist of alphabets with no spaces.";
        return;
    }

    if (!preg_match($nameRegex, $lastname)) {
        echo "Last name should only consist of alphabets with no spaces.";
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email should exist in the real world.";
        return;
    }

    if (!preg_match($usernameRegex, $username)) {
        echo "Username should be 8 characters long and consist of only alphabets and digits 0-9.";
        return;
    }

    if (!preg_match($passwordRegex, $password)) {
        echo "Password should be at least 8 characters long with at least one capital letter, one special character, and one digit.";
        return;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, password, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstname, $lastname, $username, $password, $email);

    if ($stmt->execute()) {
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Registration Successful</title>";
        echo "<link rel='stylesheet' href='../style.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<h2>Registration successful!</h2>";
        echo "<p>You have registered your account successfully.</p>";
        echo "<p>If you want to go to the portfolio website, please click on the login button below:</p>";
        echo "<a href='../login/login.html' class='button'>Login</a>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
