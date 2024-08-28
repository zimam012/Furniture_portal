<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the invoice ID from the POST request
$invoice_id = $_POST['invoice_id'];

// Delete the invoice from the database
$sql = "DELETE FROM invoices WHERE ID = $invoice_id";

if ($conn->query($sql) === TRUE) {
    echo "Invoice deleted successfully";
} else {
    echo "Error deleting invoice: " . $conn->error;
}

// Close connection
$conn->close();

// Redirect back to the invoice page
header("Location: invoice.php");
exit();
?>
