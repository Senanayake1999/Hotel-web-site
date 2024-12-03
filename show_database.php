<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connection successful!<br><br>";

// Fetch data from the database using a prepared statement (more secure)
$sql = "SELECT id, customer_name, check_in, check_out, children, rooms FROM bookings";
if ($result = $conn->query($sql)) {
    // Check if there are results
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Customer Name</th><th>Check-in</th><th>Check-out</th><th>Children</th><th>Rooms</th></tr>";

        // Output each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['check_in']) . "</td>";
            echo "<td>" . htmlspecialchars($row['check_out']) . "</td>";
            echo "<td>" . htmlspecialchars($row['children']) . "</td>";
            echo "<td>" . htmlspecialchars($row['rooms']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found in the database.";
    }

    // Free result set
    $result->free();
} else {
    echo "Error in SQL query: " . $conn->error;
}

// Close connection
$conn->close();
?>
