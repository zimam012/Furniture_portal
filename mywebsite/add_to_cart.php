<?php
// Include your database connection file
include 'db_connection.php';

// Check if product_id and quantity are set
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $customer_id = 1; // Set the customer ID (you can replace this with the actual customer ID)

    // Fetch the price of the product
    $stmt = $conn->prepare("SELECT Price FROM products WHERE ID = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($product = $result->fetch_assoc()) {
        $price = $product['Price'];

        // Insert into the cart table
        $stmt = $conn->prepare("INSERT INTO cart (CustomerID, ProductID, Quantity, Price, Date) VALUES (?, ?, ?, ?, CURDATE())");
        $stmt->bind_param("iiid", $customer_id, $product_id, $quantity, $price);

        if ($stmt->execute()) {
            echo "Product added to cart successfully.";
            header("location: product_list.php");
            exit();
        } else {
            echo "Error adding product to cart.";
        }
    } else {
        echo "Product not found.";
    }

    $stmt->close();
} else {
    echo "No product or quantity selected.";
}

// Close the database connection
$conn->close();
?>
