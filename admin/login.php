<?php
// Start the session
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL query to find the admin user
    $stmt = $conn->prepare("SELECT * FROM admins WHERE AdminEmail = ? AND AdminPassword = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login
        $_SESSION['admin_email'] = $email; // Store admin email in session
        header("Location: dash/admin.php"); // Redirect to admin dashboard
        exit();
    } else {
        // Invalid credentials
        $error = "Invalid email or password.";
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    

                <style>
                    /* Reset some default styles */
            body, h2, p, form, input, button {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Roboto', sans-serif;
                background: linear-gradient(135deg, #808080, #ACB6E5); /* Background gradient */
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .login-container {
                background: #FFFFFF;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                max-width: 400px;
                width: 100%;
            }

            h2 {
                text-align: center;
                color: #333;
                margin-bottom: 20px;
                font-size: 24px;
                font-weight: 600;
            }

            .form-group {
                margin-bottom: 15px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                color: #555;
                font-weight: 500;
            }

            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 12px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 16px;
                color: #333;
                background-color: #f9f9f9;
                transition: border-color 0.3s ease;
            }

            input[type="email"]:focus,
            input[type="password"]:focus {
                border-color: #74ebd5; /* Focus border color */
                outline: none;
            }

            button {
                width: 100%;
                padding: 12px;
                background-color: #808080; /* Button background color */
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            button:hover {
                background-color: #ACB6E5; /* Button hover color */
            }

            .error {
                color: #e74c3c; /* Error message color */
                margin-top: 10px;
                text-align: center;
                font-size: 14px;
            }

            /* Responsive Design */
            @media (max-width: 480px) {
                .login-container {
                    padding: 20px;
                }
                
                h2 {
                    font-size: 20px;
                }
                
                input[type="email"],
                input[type="password"],
                button {
                    font-size: 14px;
                }
            }

            </style>


</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <?php
            if (!empty($error)) {
                echo "<p class='error'>$error</p>";
            }
            ?>
        </form>
    </div>
</body>
</html>
