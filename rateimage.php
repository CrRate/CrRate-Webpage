<?php
    $rating = $_POST['rating'];
    $image_id = $_POST['imageID'];

    $conn = mysqli_connect("localhost", "root", "", "crabDB");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE images SET rating=rating+'$rating',rating_amount = rating_amount+1 WHERE id = '$image_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Upvote successful!";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>