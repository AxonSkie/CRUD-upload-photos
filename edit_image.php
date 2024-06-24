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

// Check if ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to fetch image details from database
    $result = $db->query("SELECT * FROM images WHERE id = $id");
    $row = $result->fetch_assoc();

    if (!$row) {
        die("Image not found.");
    }
} elseif (isset($_POST['id']) && isset($_POST['description'])) {
    // Handle the form submission to update the image description
    $id = $_POST['id'];
    $description = $_POST['description'];

    // Update image description in the database
    $update = $db->query("UPDATE images SET description = '$description' WHERE id = $id");

    if ($update) {
        echo "Image description updated successfully.";
    } else {
        echo "Error updating image description.";
    }

    // Close database connection
    $db->close();

    // Redirect back to the show images page
    header("Location: show_image.php");
    exit;
} else {
    die("Invalid request.");
}

// Close database connection
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Image Description</title>
    <link rel="stylesheet" href="edit.css">

</head>
<body>

<div class="container1">
    <div class="box">
        <a href="show_image.php"><img src="text-1719035573245.png" alt=""></a>
        <img src="art.png" alt="" class="art">
    </div>

    <div class="box2">

  

    <form action="edit_image.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <p>
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" cols="50"><?php echo htmlspecialchars($row['description']); ?></textarea>
        </p>
        <p>
            <input type="submit" value="Update">
        </p>
    </form>
 
    </div>



</div>
   
</body>
</html>
