<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if review ID is set
if (isset($_POST['review_id'])) {
    $review_id = $_POST['review_id'];

    // Delete the review with the given ID
    $sql = "DELETE FROM reviews WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $review_id);

    if ($stmt->execute()) {
        echo "Review deleted successfully.";
    } else {
        echo "Error deleting review: " . $conn->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();

// Redirect back to reviews page
header("Location: reviews.php");
exit;
?>

