<?php

$dbHost = 'localhost';
$dbUsername = 'root';  
$dbPassword = '';      
$dbName = 'image_upload'; 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


$result = $db->query("SELECT * FROM images");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show Images</title>
    <link rel="stylesheet" href="showimage.css">
    
</head>
<body>

<div class="container1">

<div class="box2">

<img src="text-1719035573245.png" alt="">
<img src="art.png" alt="" class="art">

</div>

<div class="box3">


<h2><a href="index.php"><</a></h2>

</div>




    </div>
    <div class="container">
        <div class="gallery">
            <?php
           
            while ($row = $result->fetch_assoc()) {
                $imagePath = 'uploads/' . $row['image_name']; 
                $description = $row['description'];
                $imageId = $row['id']; 

                
                ?>
                <div class="image">
                    <img src="<?php echo $imagePath; ?>" alt="<?php echo $description; ?>" width="300">
                    <p>Description: <?php echo $description; ?></p>
                    <div class="button-container">

                    <div class="box">
                        <form action="delete_image.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $imageId; ?>">
                            <input type="hidden" name="image_name" value="<?php echo $row['image_name']; ?>">
                            <input type="submit" value="Delete">
                        </form>
                        
                        <form action="edit_image.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $imageId; ?>">
                            <input type="submit" value="Edit">
                        </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <?php
    
    $db->close();
    ?>
</body>
</html>
