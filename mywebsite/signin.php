<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>

<div class="form-container login-container">
    <a href="../index.php" class="home-button">Home</a>
    <h2>Login</h2>
    <p>Please enter your email and password!</p>
    <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <div class="social-login">
        <img src="https://img.icons8.com/fluent/48/000000/facebook-new.png" alt="Facebook">
        <img src="https://img.icons8.com/fluent/48/000000/twitter.png" alt="Twitter">
        <img src="https://img.icons8.com/fluent/48/000000/google-logo.png" alt="Google">
    </div>
    <div class="signup-link">
        <a href="register.php">Don't have an account? Register</a>
    </div>
</div>

</body>
</html>
