<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the product category ID from the POST request
$category_id = $_POST['category_id'];

// Delete the product category from the database
$sql = "DELETE FROM productcategories WHERE ID = $category_id";

if ($conn->query($sql) === TRUE) {
    echo "Product category deleted successfully";
} else {
    echo "Error deleting product category: " . $conn->error;
}

// Close connection
$conn->close();

// Redirect back to the product category page
header("Location: product-category.php");
exit();
?>
