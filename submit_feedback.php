<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedback_form";
// $servername = "sql213.infinityfree.com";
// $username = "if0_36985874";
// $password = "DzaCI7nPzhLfkj";
// $dbname = "if0_36985874_feedback_form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$submitted_data = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $rating = $conn->real_escape_string($_POST['rating']);
    $feedback = $conn->real_escape_string($_POST['feedback']);

    $sql = "INSERT INTO feedback (name, email, rating, feedback) VALUES ('$name', '$email', '$rating', '$feedback')";

    if ($conn->query($sql) === TRUE) {
        $message = "Thank you for your feedback!";
        $submitted_data = "You submitted the following details:<br>Name: $name<br>Email: $email<br>Rating: $rating<br>Feedback: $feedback<br><br>";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $message = "No POST data received";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Received</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section id="feedback-message" class="feedback-message">
        <div class="feedback-text">
            <h2>Feedback <span>Received</span></h2>
            <h4><?php echo $submitted_data . $message; ?></h4>
            <p>We appreciate your feedback and will use it to improve our services.</p>
        </div>
    </section>
</body>
</html>
