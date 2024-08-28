<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Furniture Shop</title>
    <style>
        /* Internal CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        .header .logo {
            font-size: 2em;
            font-weight: bold;
        }

        .header .logo span {
            color: #e8491d;
        }

        .nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            text-align: center;
        }

        .nav ul li {
            display: inline;
        }

        .nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 14px 20px;
            display: inline-block;
        }

        .nav ul li a:hover {
            background-color: #e8491d;
        }

        .about-section {
            padding: 40px 20px;
            text-align: center;
        }

        .about-section h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .about-section p {
            font-size: 1.1em;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
        }

        .categories {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 40px 20px;
        }

        .category-item {
            margin: 10px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
            width: 200px;
        }

        .category-item img {
            width: 100%;
            height: auto;
        }

        .category-item h3 {
            margin: 15px 0;
            font-size: 1.2em;
            color: #333;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1 class="logo">Furniture<span>Shop</span></h1>
            <nav class="nav">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="signin.php">Sign In</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="about-section">
        <h2>About Us</h2>
        <p>Welcome to Furniture Shop, your number one source for high-quality and stylish furniture. We're dedicated to giving you the very best of home furnishings, with a focus on quality, customer service, and uniqueness. Our wide range of products includes everything from modern to classic styles, ensuring that you'll find the perfect piece to complete your home. We are committed to bringing you the best in furniture, whether you're outfitting your living room, dining room, or outdoor space.</p>
        <p>Founded in 2024, Furniture Shop has come a long way from its beginnings as a small startup. When we first started out, our passion for providing eco-friendly and affordable furniture drove us to start this business so that Furniture Shop can offer you furniture that is both stylish and sustainable. We now serve customers all over the country and are thrilled to be a part of the home furnishing industry.</p>
        <p>We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us.</p>
    </section>

    <section class="categories">
        <div class="category-item">
            <img src="images/chair.jpg" alt="Chairs">
            <h3>Chairs</h3>
        </div>
        <div class="category-item">
            <img src="images/table.jpg" alt="Tables">
            <h3>Tables</h3>
        </div>
        <div class="category-item">
            <img src="images/sofa.jpg" alt="Sofas">
            <h3>Sofas</h3>
        </div>
        <div class="category-item">
            <img src="images/bed.jpg" alt="Beds">
            <h3>Beds</h3>
        </div>
        <div class="category-item">
            <img src="images/wardropes.jpg" alt="Wardrobes">
            <h3>Wardrobes</h3>
        </div>
        <div class="category-item">
            <img src="images/shelves.jpg" alt="Shelves">
            <h3>Shelves</h3>
        </div>
        <div class="category-item">
            <img src="images/Desks.jpg" alt="Desks">
            <h3>Desks</h3>
        </div>
        <div class="category-item">
            <img src="images/cabinet.jpg" alt="Cabinets">
            <h3>Cabinets</h3>
        </div>
        <div class="category-item">
            <img src="images/Lamps.jpg" alt="Lamps">
            <h3>Lamps</h3>
        </div>
        <div class="category-item">
            <img src="images/outdoor furniture.jpg" alt="Outdoor Furniture">
            <h3>Outdoor Furniture</h3>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2024 Furniture Shop. All rights reserved.</p>
    </footer>
</body>
</html>
