<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$name = $_POST['name'];
$contact = $_POST['contact'];
$email = $_POST['email'];

// Prepare and execute SQL query
$sql = "INSERT INTO suppliers (Name, Contact, Email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $contact, $email);

if ($stmt->execute()) {
    // Redirect to the supplier page after successful addition
    header("Location: supplier.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
