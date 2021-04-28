<html>
    <head>
        <link rel="stylesheet" type="text/css" href="pagestyle.css">
        <title>Gallery</title>
    </head>
    <body>
        <h1>
            The Gallery
        </h1>
        <?php include 'menu.php'; ?>
        <div id = "content">
            <?php
                $db = mysqli_connect("localhost", "root", "", "crabDB");
                $result = $db or die("Could not connect to database." .mysqli_error());
                mysqli_select_db($result,"crabDB") or die("Could not select the database." .mysqli_error());
                $image_query = mysqli_query($result,"SELECT * FROM images ORDER BY rating DESC");
                $rows = mysqli_fetch_array($image_query);
                $row = mysqli_num_rows($image_query);
                if($row>0) {
                    do {
                        $img_name = $rows['description'];
                        $img_src = $rows['image_path'];
                        $image_rating = $rows['rating'];
                        $image_rating_amount = $rows['rating_amount'];
                        if($image_rating_amount <= 0) {
                            $image_final_rating = 'Unrated';
                        } else {
                            $image_final_rating = round($image_rating/$image_rating_amount,1);
                        }
                        echo "<div class=\"img-block\"><img src=".$img_src." alt=\"\" title=".$img_name." height=\"200\"/>
                        <p><strong>Rating:".$image_final_rating."<br>".$img_name."</strong></p></div>";
                    } while($rows = mysqli_fetch_array($image_query));
                }
            ?>
        </div>
        <script src="js/jquery-1.11.0.js"></script>
        <script src="js/animate.js"></script>
    </body>
</html>