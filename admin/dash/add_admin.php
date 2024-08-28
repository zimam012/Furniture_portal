<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$adminid = $_POST['id'];
$adminname = $_POST['adminname'];
$adminpassword = $_POST['adminpassword'];
$adminemail = $_POST['adminemail'];



// To Add
$sql = "INSERT INTO admins (adminname, adminpassword, adminemail) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $adminname, $adminpassword, $adminemail);

if ($stmt->execute()) {
    // Redirect to the admin page after successful addition
    header("Location: admin.php");
} else {
    echo "Error: " . $stmt->error;
}



// To Delete
$sql = "DELETE FROM admins WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $adminid);

if ($stmt->execute()) {
    // Redirect to the admin page after successful deletion
    header("Location: admin.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>

