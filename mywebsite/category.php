<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Products</title>
    <link rel="stylesheet" href="../css/style1.css">
</head>
<body>
<header class="header">
    <div class="header-content">
        <h1 class="logo">Furniture<span>Shop</span></h1>
        <nav class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="signin.php">Sign In</a></li>
            </ul>
        </nav>
    </div>
</header>

<?php
include('../mywebsite/db_connection.php'); // Ensure this file contains your $conn variable

// Get the category ID from the URL
$categoryID = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch and display category name
$categoryQuery = "SELECT name FROM productcategories WHERE ID = ?";
$stmt = $conn->prepare($categoryQuery);
$stmt->bind_param("i", $categoryID);
$stmt->execute();
$categoryResult = $stmt->get_result();
$category = $categoryResult->fetch_assoc();

if (!$category) {
    echo '<p>Category not found.</p>';
    exit;
}

// Fetch and display products for the selected category
// Assuming $conn is your database connection
$productQuery = "SELECT Name, Price, URL, StockQuantity FROM products WHERE CategoryID = ?";

$stmt = $conn->prepare($productQuery);
$stmt->bind_param("i", $categoryID);
$stmt->execute();
$productResult = $stmt->get_result();

?>

<section class="category-section">
    <div class="container">
        <h2 class="section-title">Products in <?php echo htmlspecialchars($category['name']); ?></h2>
        <div class="category-grid">
            <?php
            if ($productResult->num_rows > 0) {
                // Iterate through each product and display it
                while ($product = $productResult->fetch_assoc()) {
                    $productName = htmlspecialchars($product['Name']);
                    $productPrice = number_format($product['Price'], 2);
                    $productURL = htmlspecialchars($product['URL']);
                    $productQuantity = isset($product['StockQuantity']) ? $product['StockQuantity'] : 'N/A';

                    echo '<div class="category-item">';
                    echo '<img src="../'.$productURL.'" alt="' . $productName . '">';
                    echo '<h3>' . $productName . '</h3>';
                    echo '<p>Rs' . $productPrice . '</p>';
                    echo '<p>Quantity: ' . $productQuantity . '</p>';
                    echo '</div>';
                }
            } else {
                // Message displayed when no products are found
                echo 'No products found in this category.';
            }
            ?>
        </div>
    </div>
</section>


<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Furniture Shop. All rights reserved.</p>
        <ul class="social-links">
            <li><a href="#"><img src="facebook-icon.png" alt="Facebook"></a></li>
            <li><a href="#"><img src="twitter-icon.png" alt="Twitter"></a></li>
            <li><a href="#"><img src="instagram-icon.png" alt="Instagram"></a></li>
        </ul>
    </div>
</footer>
</body>
</html>
