<?php
// Database configuration
$servername = "localhost"; // Change if your server is different
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "esports"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $teamName = $_POST['teamName'];
    $player1 = $_POST['player1'];
    $player2 = $_POST['player2'];
    $player3 = $_POST['player3'];
    $player4 = $_POST['player4'];
    $contactEmail = $_POST['contact'];
    $contactPhone = $_POST['phone'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO team_registrations (team_name, player1_name, player2_name, player3_name, player4_name, contact_email, contact_phone) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $teamName, $player1, $player2, $player3, $player4, $contactEmail, $contactPhone);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
