<?php
    if (isset($_POST['upvote'])) {
        $conn = mysqli_connect("localhost", "root", "", "crabDB");
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $image_id = $_POST['upvote'];
        $new_rating = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM images"))['rating']+1;
        echo "new rating: $new_rating";
        echo "image id: $image_id";
        $sql = "UPDATE images SET rating=$new_rating WHERE id = '$image_id'";

        if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
        // Get image name
        /*$image = $_FILES['image']['name'];
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
        */
    }
    if (isset($_POST['next'])) {
        /*
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
        mysqli_stmt_execute($stmt);*/
        
        // execute query
        #mysqli_query($db, $sql) or die(mysqli_error($db));

        
        #echo $msg;
    }
?>
<html>
    <body>
        <h1>
            "This is the Rating Page"
        </h1>
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
            <!-- Show random image -->
            <?php
                $db = mysqli_connect("localhost", "root", "", "crabDB");
                $result = $db or die("Could not connect to database." .mysqli_error());
                mysqli_select_db($result,"crabDB") or die("Could not select the database." .mysqli_error());
                $random_image_query = mysqli_query($result,"SELECT * FROM images ORDER BY RAND() LIMIT 1");
                #var_dump($image_query);
                #if($image_query instanceof mysqli_result) {
                $rows = mysqli_fetch_array($random_image_query);
                $row = mysqli_num_rows($random_image_query);
                if($row>0) {
                    $img_name = $rows['description'];
                    $img_src = $rows['image_path'];
                    $image_rating = $rows['rating'];
                    $image_id = $rows['id'];
                    ?>
                    <div class="img-block">
                    <img src="<?php echo $img_src; ?>" alt="" title="<?php echo $img_name; ?>" class="img-responsive" />
                    <p><strong>Rating: <?php echo $image_rating; ?><br><?php echo $img_name; ?></strong></p>
                    </div>
                    
                    <?php
                }
            ?>
            <form method="POST" action="">
                <div>
                    <button type="submit" name="upvote" value=<?php $image_id;?>>Upvote</button>
                    <button type="submit" name="next">Next</button>
                </div>
            </form>
            <?php echo $image_id;?>
        </div>
    </body>
</html>