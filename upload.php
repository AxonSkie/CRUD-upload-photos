<?php
// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Directory where uploaded images will be saved (absolute path)
    $targetDir = __DIR__ . '/uploads/';

    // File path of the uploaded image
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    // Variable to track if upload is successful
    $uploadOk = 1;

    // Get image file type
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) { // 500KB
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    } else {
        // Attempt to move uploaded file to target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.<br>";

            // Get filename and description from form
            $filename = basename($_FILES["image"]["name"]);
            $description = $_POST['description'];

            // Insert image filename and description into database
            $insert = $db->query("INSERT INTO images (image_name, description) VALUES ('$filename', '$description')");
            if ($insert) {
                echo "File uploaded and description added successfully.<br>";
            } else {
                echo "File upload failed, please try again.<br>";
            }
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }

    // Close database connection
    $db->close();
} else {
    echo "Sorry, your request method is not allowed.<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="upload.css">

</head>
<body>
    <div class="container">
        
    </div>

    <div class="container2">

    <img src="text-1719035573245.png" alt="">
    </div>
    <div class="box">
    <a href="index.php"><img src="GonrBOS.jpeg" alt="" class="art"></a>
    </div>
</body>
</html>
