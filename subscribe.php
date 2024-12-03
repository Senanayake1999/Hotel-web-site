<?php
// Database connection details
$servername = "localhost";  // Replace with your database server
$username = "root";         // Replace with your database username
$password = "";             // Replace with your database password
$dbname = "newsletter";     // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Data insert successfully.<br><h3>....Thank you for joining our website!</h3>";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize the input
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare the SQL query to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO newsletter (email) VALUES (?)");
        $stmt->bind_param("s", $email);

        // Execute the query
        if ($stmt->execute()) {
            echo "<h3>Thank you for subscribing, " . htmlspecialchars($email) . "!</h3>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<h3>Please enter a valid email address.</h3>";
    }
}

// Close the connection
$conn->close();
?>
