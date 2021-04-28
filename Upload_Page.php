<?php
    require 'sqlsetup.php';
    // Initialize message variable
    $msg = "";

    // If upload button is clicked ...
    if (isset($_POST['upload'])) {
        // Get image name
        $image = $_FILES['image']['name'];
        #define ('SITE_ROOT', realpath(dirname($image)));
        if($image != null) {
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

            $sql = "INSERT INTO images (image, image_path, description, rating, rating_amount) VALUES (?,?,?,?,?)";

            $stmt = mysqli_prepare($db, $sql);
            if (false===$stmt) {
                die('prepare() failed: ' . mysqli_error($db));
            }
            mysqli_stmt_bind_param($stmt, 'bssii', $image, $target, $image_text, $startingRating,$startingRating);
            mysqli_stmt_execute($stmt);
            
            // execute query
            #mysqli_query($db, $sql) or die(mysqli_error($db));

            
            #echo $msg;
        }
        
    }
    #$result = mysqli_query($db, "SELECT * FROM images");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="pagestyle.css">
<title>Image Upload</title>
</head>
<body>
    <h1>
        Uploads
    </h1>
    <?php include 'menu.php'; ?>
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
<script src="js/jquery-1.11.0.js"></script>
<script src="js/animate.js"></script>

</body>
</html>