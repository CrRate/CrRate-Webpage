<!DOCTYPE html>
<html>
<body>

<?php
    $image_id = $_GET['imageID'];
    $conn = mysqli_connect("localhost", "root", "", "crabDB");
    $result = $conn or die("Could not connect to database." .mysqli_error());
    mysqli_select_db($result,"crabDB") or die("Could not select the database." .mysqli_error());
    $random_image_query = mysqli_query($result,"SELECT * FROM images WHERE id = '$image_id'");
    $rows = mysqli_fetch_array($random_image_query);
    $img_name = $rows['description'];
    $img_src = $rows['image_path'];
    $image_rating = $rows['rating'];
    $image_rating_amount = $rows['rating_amount'];
    if($image_rating_amount <= 0) {
        $image_final_rating = 'Unrated';
    } else {
        $image_final_rating = round($image_rating/$image_rating_amount,1);
    }
    echo "<div class=\"img-block\"><img src=".$img_src." alt=\"\" title=".$img_name." height=\"500\" />
    <p><strong>Rating:".$image_final_rating."<br>".$img_name."</strong></p></div>";
    mysqli_close($conn);
?>
</body>
</html>