<?php
// Configuration for database connection
$dbHost = 'localhost';
$dbUsername = 'root';  // Replace with your database username
$dbPassword = '';      // Replace with your database password
$dbName = 'image_upload'; // Replace with your database name

// Connect to database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if ID and image name are set
if (isset($_POST['id']) && isset($_POST['image_name'])) {
    $id = $_POST['id'];
    $imageName = $_POST['image_name'];
    $imagePath = __DIR__ . '/uploads/' . $imageName;

    // Delete the image record from the database
    $delete = $db->query("DELETE FROM images WHERE id = $id");

    if ($delete) {
        // Delete the image file from the server
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        echo "Image deleted successfully.";
    } else {
        echo "Error deleting image.";
    }
} else {
    echo "Invalid request.";
}

// Close database connection
$db->close();

// Redirect back to the show images page
header("Location: show_image.php");
exit;
?>
