<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Category</title>
    <link rel="stylesheet" href="../css/astyle.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Inventory Management System</h1>
    </header>
    <nav>
        <ul>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="customer.php">Customer</a></li>
            <li><a href="supplier.php">Supplier</a></li>
            <li><a href="invoice.php">Invoice</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="product-category.php">Product Category</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="reviews.php">Reviews</a></li>
        </ul>

        <!-- Search form -->
        <form action="product-category.php" method="get" style="float: right; margin-top: 15px;">
            <input type="text" name="search_name" placeholder="Search by Category Name">
            <button type="submit">Search</button>
        </form>
    </nav>

    <main>
        <h2>Product Category</h2>

        <form class="AForm" action="add_product_category.php" method="post">
            <label for="categoryName">Category Name:</label>
            <input type="text" id="categoryName" name="categoryName" required>
            <br>
            <label for="imageURL">Image URL:</label>
            <input type="text" id="imageURL" name="imageURL" required>
            <br>
            <button type="submit">Add Category</button>
        </form>


        <table>
            <thead>
                <tr>
                    <?php
                    // Database connection
                    $conn = new mysqli("localhost", "root", "", "furniture_shop");

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Query to fetch column names
                    $result = $conn->query("SHOW COLUMNS FROM productcategories");

                    // Display column names as table headers
                    while ($row = $result->fetch_assoc()) {
                        echo "<th>" . $row['Field'] . "</th>";
                    }
                    echo "<th>Action</th>";
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Search functionality
                if (isset($_GET['search_name']) && !empty($_GET['search_name'])) {
                    $search_name = $conn->real_escape_string($_GET['search_name']);
                    $sql = "SELECT * FROM productcategories WHERE name LIKE '%$search_name%'";
                } else {
                    $sql = "SELECT * FROM productcategories";
                }

                // Query to fetch category data
                $result = $conn->query($sql);

                // Display category data with delete button
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        foreach ($row as $column) {
                            echo "<td>" . $column . "</td>";
                        }
                        echo "<td>";
                        echo "<form action='delete_product-category.php' method='post' onsubmit='return confirm(\"Are you sure you want to delete this category?\");'>";
                        echo "<input type='hidden' name='category_id' value='" . $row['ID'] . "'>";
                        echo "<button type='submit'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No categories found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
