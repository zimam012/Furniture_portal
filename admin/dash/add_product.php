<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$name = $_POST['name'];
$category = $_POST['category'];
$supplier = $_POST['supplier'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$url = $_POST['url'];

// Prepare and execute SQL query
$sql = "INSERT INTO products (Name, CategoryID, SupplierID, Price, StockQuantity, URL) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siidss", $name, $category, $supplier, $price, $stock, $url);

if ($stmt->execute()) {
    // Redirect to the products page after successful addition
    header("Location: products.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
