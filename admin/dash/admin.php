<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
        <form action="admin.php" method="get" style="float: right; margin-top: 15px;">
            <input type="text" name="search_text" placeholder="Search by Admin Name">
            <button type="submit">Search</button>
        </form>
    </nav>

    <main>
        <h2>Admin</h2>

        <!-- Form to Add New Admin -->
        <form class="AForm" action="add_admin.php" method="post">
            <label for="adminname">Admin Name:</label>
            <input type="text" id="adminname" name="adminname" required>
            <br>
            <label for="adminemail">Admin Email:</label>
            <input type="email" id="adminemail" name="adminemail" required>
            <br>
            <label for="adminpassword">Admin Password:</label>
            <input type="password" id="adminpassword" name="adminpassword" required>
            <br>
            <button type="submit">Add Admin</button>
        </form>

        <!-- Table to Display Admin Data -->
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
                    $result = $conn->query("SHOW COLUMNS FROM admins");
                    
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
                if (isset($_GET['search_text']) && !empty($_GET['search_text'])) {
                    $search_text = $conn->real_escape_string($_GET['search_text']);
                    $sql = "SELECT * FROM admins WHERE AdminName LIKE '%$search_text%'";
                } else {
                    $sql = "SELECT * FROM admins";
                }

                // Query to fetch admin data
                $result = $conn->query($sql);

                // Display admin data with delete button
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        foreach ($row as $column) {
                            echo "<td>" . $column . "</td>";
                        }
                        echo "<td>";
                        echo "<form action='delete_admin.php' method='post' onsubmit='return confirm(\"Are you sure you want to delete this admin?\");'>";
                        echo "<input type='hidden' name='admin_id' value='" . $row['AdminID'] . "'>";
                        echo "<button type='submit'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='100%'>No results found</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>

