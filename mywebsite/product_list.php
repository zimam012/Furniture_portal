<?php
// Include your existing database connection code here
include 'db_connection.php'; // Adjust the path as needed

// Search functionality
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $products = $conn->query("SELECT * FROM products WHERE Name LIKE '%$search%'");
} else {
    $products = $conn->query("SELECT * FROM products");
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="addcart.css">
</head>
<body>

<!-- Header Section -->
<header class="header" style="background-color: #333; padding: 20px; color: white;">
    <div class="header-content" style="display: flex; justify-content: space-between; align-items: center;">
        <h1 class="logo" style="font-size: 24px; font-weight: bold; color: white;">
            Furniture<span style="color: #FF6347;">Shop</span>
        </h1>
        <nav class="nav">
            <ul style="list-style-type: none; margin: 0; padding: 0; display: flex;">
                <li style="margin-left: 20px;">
                    <a href="index.php" style="color: white; text-decoration: none; font-size: 16px; padding: 5px 10px; transition: background-color 0.3s ease, color 0.3s ease;">
                        Home
                    </a>
                </li>
                <li style="margin-left: 20px;">
                    <a href="mywebsite/about.php" style="color: white; text-decoration: none; font-size: 16px; padding: 5px 10px; transition: background-color 0.3s ease, color 0.3s ease;">
                        About Us
                    </a>
                </li>
                <li style="margin-left: 20px;">
                    <a href="mywebsite/signin.php" style="color: white; text-decoration: none; font-size: 16px; padding: 5px 10px; transition: background-color 0.3s ease, color 0.3s ease;">
                        Sign In
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<!-- Search Box and Buy Now Button -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <form method="get" action="" style="margin: 0;">
        <input type="text" name="search" placeholder="Search products..." style="padding: 10px; font-size: 16px; width: 250px; margin-right: 10px;">
        <button type="submit" style="background-color: #FF6347; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease, transform 0.3s ease;">
            Search
        </button>
    </form>

    <form action="cart.php" method="get">
        <button type="submit" style="background-color: #FF6347; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease, transform 0.3s ease;">
            See Cart Products
        </button>
    </form>
</div>

<h1>Products</h1>

<?php if ($products->num_rows > 0): ?>
    <div class="product-list">
        <?php while ($product = $products->fetch_assoc()): ?>
            <div class="product-item">
                <img src="../<?php echo htmlspecialchars($product['URL']); ?>" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                <h3><?php echo htmlspecialchars($product['Name']); ?></h3>
                <p>Price: Rs <?php echo htmlspecialchars($product['Price']); ?></p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['ID']); ?>">
                    <label for="quantity_<?php echo htmlspecialchars($product['ID']); ?>">Quantity:</label>
                    <input type="number" id="quantity_<?php echo htmlspecialchars($product['ID']); ?>" name="quantity" value="1" min="1">
                    <button type="submit" onclick="addtocart()">Add to Cart</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>No products found.</p>
<?php endif; ?>

<script>
    function addtocart() {
        alert("Added to Cart");
    }
</script>

</body>
</html>
