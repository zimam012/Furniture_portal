<?php
// Start session to handle login
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="cardstyle.css"> <!-- Link to the CSS file -->
</head>
<body>

<?php
// Include your database connection file
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_SESSION['customer_id'])) {
    $customer_name = $_POST['customer_name'];
    $password = $_POST['password'];

    // Validate the customer name and password
    $stmt = $conn->prepare("SELECT ID, Name, Address FROM customers WHERE Name = ? AND password = ?");
    $stmt->bind_param("ss", $customer_name, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Customer found, save customer details in session
        $customer = $result->fetch_assoc();
        $_SESSION['customer_id'] = $customer['ID'];
        $_SESSION['customer_name'] = $customer['Name'];
        $_SESSION['customer_address'] = $customer['Address'];
    } else {
        echo "<p>Invalid customer name or password.</p>";
    }

    $stmt->close();
}

// Check if customer is logged in
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    $customer_name = $_SESSION['customer_name'];
    $customer_address = $_SESSION['customer_address'];

    echo '<div style="max-width: 800px; margin: auto; padding: 20px;">';

    // Fetch items from the cart for the logged-in customer
    $stmt = $conn->prepare("SELECT p.Name, p.Price, c.Quantity, c.Date 
                            FROM cart c 
                            JOIN products p ON c.ProductID = p.ID 
                            WHERE c.CustomerID = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Calculate total amount
    $total_amount = 0;

    if ($result->num_rows > 0) {
        echo "<h1>Your Cart</h1>";
        echo "<p><strong>Customer Name:</strong> " . htmlspecialchars($customer_name) . "</p>";
        echo "<p><strong>Customer ID:</strong> " . htmlspecialchars($customer_id) . "</p>";
        echo "<p><strong>Customer Address:</strong> " . htmlspecialchars($customer_address) . "</p>";
        echo "<p><strong>Date:</strong> " . date('Y-m-d') . "</p>";

        echo "<table border='1' style='width: 100%; border-collapse: collapse;'>
                <tr>
                    <th style='padding: 10px;'>Product Name</th>
                    <th style='padding: 10px;'>Price</th>
                    <th style='padding: 10px;'>Quantity</th>
                    <th style='padding: 10px;'>Total Price</th>
                </tr>";

        // Display the cart items
        while ($row = $result->fetch_assoc()) {
            $item_total = $row['Price'] * $row['Quantity'];
            $total_amount += $item_total;

            echo "<tr>
                    <td style='padding: 10px;'>" . htmlspecialchars($row['Name']) . "</td>
                    <td style='padding: 10px;'>Rs " . htmlspecialchars($row['Price']) . "</td>
                    <td style='padding: 10px;'>" . htmlspecialchars($row['Quantity']) . "</td>
                    <td style='padding: 10px;'>Rs " . htmlspecialchars($item_total) . "</td>
                  </tr>";
        }
        echo "</table>";

        // Display total amount
        echo "<p><strong>Total Amount:</strong> Rs " . htmlspecialchars($total_amount) . "</p>";

        // Add a "Buy Now" button
        echo '<form action="finalize_purchase.php" method="post" style="margin-top: 20px;">
                <button type="submit" style="background-color: #FF6347; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                    Buy Now
                </button>
              </form>';
    } else {
        echo "<p>Your cart is empty.</p>";
    }

    echo '</div>'; // Close the container div

    $stmt->close();
} else {
    // Display login form if not logged in
    echo '<div style="max-width: 500px; margin: auto; padding: 20px;">';
    echo '<h1>Confirm your order</h1>
          <form method="post" action="cart.php">
              <label for="customer_name">Name:</label>
              <input type="text" name="customer_name" id="customer_name" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
              <br>
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" required style="width: 100%; padding: 10px; margin-bottom: 20px;">
              <br>
              <button type="submit" style="background-color: #FF6347; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                  Login
              </button>
          </form>';
    echo '</div>'; // Close the container div
}

// Close the database connection
$conn->close();
?>

</body>
</html>
