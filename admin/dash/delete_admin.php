<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the admin ID is set
if (isset($_POST['admin_id'])) {
    $admin_id = $_POST['admin_id'];

    // SQL query to delete the admin
    $sql = "DELETE FROM admins WHERE AdminID = $admin_id";

    if ($conn->query($sql) === TRUE) {
        echo "Admin deleted successfully";
    } else {
        echo "Error deleting admin: " . $conn->error;
    }
}

// Close connection
$conn->close();

// Redirect back to the admin page
header("Location: admin.php");
exit();
?>
