<?php
    require 'sqlsetup.php';
    // Initialize message variable
    $msg = "";

    // If upload button is clicked ...
    if (isset($_POST['upload'])) {
        
        // Get image name
        $image = $_FILES['image']['name'];
        #define ('SITE_ROOT', realpath(dirname($image)));
        // Get text
        $image_text = mysqli_real_escape_string($db, $_POST['image_text']);

        // image file directory
        $target = 'images/'.basename($image);
        $startingRating = 0;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }

        $sql = "INSERT INTO images (image, image_path, description, rating) VALUES (?,?,?,?)";

        $stmt = mysqli_prepare($db, $sql);
        if (false===$stmt) {
            die('prepare() failed: ' . mysqli_error($db));
        }
        mysqli_stmt_bind_param($stmt, 'bssi', $image, $target, $image_text, $startingRating);
        mysqli_stmt_execute($stmt);
        
        // execute query
        #mysqli_query($db, $sql) or die(mysqli_error($db));

        
        #echo $msg;
    }
    #$result = mysqli_query($db, "SELECT * FROM images");
?>
<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>
</head>
<body>
    <div id="tabs">
        <form method="POST" action="Upload_Page.php">
            <input type="submit" value = "Upload"/>
        </form>
        <form method="POST" action="Rating_Page.php">
            <input type="submit" value = "Rate"/>
        </form>
        <form method="POST" action="Gallery_Page.php">
            <input type="submit" value = "Gallery"/>
        </form>
    </div>
    <div id="content">
    <form method="POST" action="Upload_Page.php" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <div>
        <input type="file" name="image">
        </div>
        <div>
        <textarea 
            id="text" 
            cols="40" 
            rows="4" 
            name="image_text" 
            placeholder="Say something about this image..."></textarea>
        </div>
        <div>
            <button type="submit" name="upload">POST</button>
        </div>
    </form>
</div>
</body>
</html>