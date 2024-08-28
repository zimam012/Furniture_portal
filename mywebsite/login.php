<?php
// Include your existing database connection code here
include '../mywebsite/db_connection.php'; // Adjust the path as needed

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT * FROM customers WHERE Email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login
        header("Location: ../mywebsite/product_list.php"); // Redirect to shop page
        exit();
    } else {
        // Invalid credentials
        echo "Invalid email or password.";
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
