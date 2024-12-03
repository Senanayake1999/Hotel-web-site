<?php
// Database connection settings
$servername = "localhost"; // Change to your server address if not localhost
$username = "root";        // Replace with your MySQL username
$password = "";            // Replace with your MySQL password
$dbname = "login_data"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connection established successfully!";
}


// Check if form is submitted
// Example: Validate login (you can use database verification here)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    

    // Example validation (you should replace this with real validation)
    if ($username == "admin" && $password == "12345") {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.html"); // Redirect to home page after login
        exit;
    } else {
        $error_message = "";
    }
}
?>

<!-- The login form -->
<form method="POST" action="login.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    
    <input type="submit" value="Login">
    
    <?php
    if (isset($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>
</form>
