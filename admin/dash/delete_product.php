<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the product ID from the POST request
$product_id = $_POST['product_id'];

// Delete the product from the database
$sql = "DELETE FROM products WHERE ID = $product_id";

if ($conn->query($sql) === TRUE) {
    echo "Product deleted successfully";
} else {
    echo "Error deleting product: " . $conn->error;
}

// Close connection
$conn->close();

// Redirect back to the products page
header("Location: products.php");
exit();
?>
