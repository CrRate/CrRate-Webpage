<html>
    <body>
        <h1>
            "This is the Gallery Page"
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
        <div id = "content">
            <?php
                $db = mysqli_connect("localhost", "root", "", "crabDB");
                $result = $db or die("Could not connect to database." .mysqli_error());
                mysqli_select_db($result,"crabDB") or die("Could not select the database." .mysqli_error());
                $image_query = mysqli_query($result,"SELECT * FROM images ORDER BY rating DESC");
                #var_dump($image_query);
                #if($image_query instanceof mysqli_result) {
                $rows = mysqli_fetch_array($image_query);
                $row = mysqli_num_rows($image_query);
                if($row>0) {
                    do {
                        $img_name = $rows['description'];
                        $img_src = $rows['image_path'];
                        $image_rating = $rows['rating'];
                        ?>
                        <div class="img-block">
                        <img src="<?php echo $img_src; ?>" alt="" title="<?php echo $img_name; ?>" class="img-responsive" />
                        <p><strong>Rating: <?php echo $image_rating; ?><br><?php echo $img_name; ?></strong></p>
                        </div>
                        
                        <?php
                    } while($rows = mysqli_fetch_array($image_query));
                }
                 
                
                #}
            ?>
        </div>
    </body>
</html>