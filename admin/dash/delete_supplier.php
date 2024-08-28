<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the supplier ID from the POST request
$supplier_id = $_POST['supplier_id'];

// SQL query to delete the supplier
$sql = "DELETE FROM suppliers WHERE ID = $supplier_id";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Supplier deleted successfully";
} else {
    echo "Error deleting supplier: " . $conn->error;
}

// Close the connection
$conn->close();

// Redirect back to the supplier page
header("Location: supplier.php");
exit();
?>
