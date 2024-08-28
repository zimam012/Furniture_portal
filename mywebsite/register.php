<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>

<div class="form-container register-container">
    <h2>Register</h2>
    <p>Please fill in the details to create your account!</p>
    <form action="#" method="post">
        <input type="text" placeholder="Name" required>
        <input type="tel" name="contact_number" placeholder="Contact Number" required>
        <textarea name="address" placeholder="Address" rows="4" required></textarea>
        <input type="email" placeholder="Email" required>
        <input type="password" placeholder="Password" required>
        <input type="password" placeholder="Confirm Password" required>
        <button type="submit">Create</button>
    </form>
    <div class="social-icons">
        <img src="https://img.icons8.com/fluent/48/000000/facebook-new.png" alt="Facebook">
        <img src="https://img.icons8.com/fluent/48/000000/twitter.png" alt="Twitter">
        <img src="https://img.icons8.com/fluent/48/000000/google-logo.png" alt="Google">
    </div>
    <div class="link">
        <a href="signin.php">Already have an account? Login</a>
    </div>
</div>

</body>
</html>

