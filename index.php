<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Upload</title>
<link rel="stylesheet" href="index.css">

</head>
<body>
    
    <div class="container1">

<div class="box2">

<img src="text-1719035573245.png" alt="">
<img src="art.png" alt="" class="art">

</div>

<div class="box3">


<h2>By: Ceazar Alejo</h2>

</div>




    </div>

    <div class="container">

    <dib class="box">

<a href="show_image.php">
    <img src="icon.jpeg" alt="" class="img-1">

    <h1>View Gallery</h1>
         
    </a>



    </dib>

    <div class="box1">
    <form action="upload.php" method="post" enctype="multipart/form-data">

    <img src="upload.png" alt="" class="upload">
        <input type="file" name="image" accept="image/*" required class="btn1"><br><br>
        <textarea name="description" placeholder="Enter description here..." required></textarea><br><br>
        <input type="submit" name="submit" value="Upload" class="btn2">
    </form>
    </div>

    </div>
</body>
</html>
