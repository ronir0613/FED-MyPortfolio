<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form";
// $servername = "sql213.infinityfree.com";
// $username = "	if0_36985874";
// $password = "DzaCI7nPzhLfkj";
// $dbname = "if0_36985874_contact_form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $messag = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contacts (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$messag')";

    if ($conn->query($sql) === TRUE) {
        $message = "Thank you for your Message!";
        $submitted_data = "You submitted the following details:<br>Name: $name<br>Email: $email<br>subject: $subject<br>message: $messag<br><br>";
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
    <section id="contact-message" class="contact-message">
        <div class="contact-text">
            <h2>Received <span>Message</span></h2>
            <h4><?php echo $submitted_data . $message; ?></h4>
            <p>We appreciate your input and will use it to contact you.</p>
        </div>
    </section>
</body>
</html>
