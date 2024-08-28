<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Shop</title>
    <link rel="stylesheet" href="css/style1.css">
    
</head>
<body>
<header class="header">
        <div class="header-content">
            <h1 class="logo">Furniture<span>Shop</span></h1>
            <nav class="nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="mywebsite/about.php">About Us</a></li>
                    <li><a href="mywebsite/signin.php">Sign In</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <?php

    include('mywebsite/db_connection.php'); // Ensure this file contains your $conn variable
    ?>

    <section class="hero">
        <div class="container">
            <h2>Find Your Perfect Furniture</h2>
            <p>Modern and stylish furniture for every room in your home.</p>
            <a href="mywebsite/signin.php" class="btn">Shop Now</a>
        </div>
    </section>

 <!-- Categories Section -->
<section class="category-section">
    <div class="container">
        <!-- Section Title -->
        <h2 class="section-title">Categories</h2>

        <!-- Grid Container for Category Items -->
        <div class="category-grid">
            <?php
            // Fetch and display categories from the database
            $query = "SELECT ID, name, image FROM productcategories";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                // Iterate through each category and display it
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="category-item">';
                    echo '<a href="mywebsite/category.php?id=' . $row['ID'] . '">';
                    echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                // Message displayed when no categories are found
                echo 'No categories found.';
            }
            ?>
        </div>
    </div>
</section>



    

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Furniture Shop. All rights reserved</p>
            
        </div>
    </footer>
</body>
</html>
