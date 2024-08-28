<?php
// Start session to handle login
session_start();

// Include your database connection file
include 'db_connection.php';

// Check if customer is logged in
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    // Begin a transaction
    $conn->begin_transaction();

    try {
        // Fetch items from the cart for the logged-in customer
        $stmt = $conn->prepare("SELECT ProductID, Quantity FROM cart WHERE CustomerID = ?");
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Iterate over the cart items to update stock quantities
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['ProductID'];
            $quantity = $row['Quantity'];

            // Update the stock quantity in the products table
            $update_stmt = $conn->prepare("UPDATE products SET StockQuantity = StockQuantity - ? WHERE ID = ?");
            $update_stmt->bind_param("ii", $quantity, $product_id);
            $update_stmt->execute();

            // Check if the update was successful
            if ($update_stmt->affected_rows === 0) {
                throw new Exception("Failed to update stock for product ID: $product_id.");
            }

            $update_stmt->close();
        }

        // Insert order details into the orders table
        $order_stmt = $conn->prepare("INSERT INTO orders (CustomerID,Date, TotalPrice) VALUES (?, NOW(), ?)");
        $order_stmt->bind_param("id", $customer_id, $total_amount); // Assuming $total_amount is calculated earlier
        $order_stmt->execute();
        $order_id = $conn->insert_id; // Get the last inserted order ID
        $order_stmt->close();

        // Clear the cart
        $clear_cart_stmt = $conn->prepare("DELETE FROM cart WHERE CustomerID = ?");
        $clear_cart_stmt->bind_param("i", $customer_id);
        $clear_cart_stmt->execute();
        $clear_cart_stmt->close();

        // Commit the transaction
        $conn->commit();

echo "<script>
    alert('Purchase finalized successfully!');
    window.location.href = '../index.php';
</script>";
} catch (Exception $e) {
    // Rollback the transaction in case of error
    $conn->rollback();
    echo "<p>Failed to finalize purchase: " . $e->getMessage() . "</p>";
}
} else {
echo "<p>Please log in to finalize your purchase.</p>";
}

// Close the database connection
$conn->close();
?>
