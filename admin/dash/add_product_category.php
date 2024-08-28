<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$categoryName = $_POST['categoryName'];
$imageURL = $_POST['imageURL'];

// Prepare and execute SQL query
$sql = "INSERT INTO productcategories (CategoryName, ImageURL) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $categoryName, $imageURL);

if ($stmt->execute()) {
    // Redirect to the product categories page after successful addition
    header("Location: product-category.php");
    exit(); // Ensure no further code is executed
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
