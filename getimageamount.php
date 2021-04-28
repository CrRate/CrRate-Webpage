<?php
    $conn = mysqli_connect("localhost", "root", "", "crabDB") or die("Could not connect to database." .mysqli_error()); 
    mysqli_select_db($conn,"crabDB") or die("Could not select the database." .mysqli_error());
    $result = mysqli_query($conn,"SELECT * FROM images");
    echo mysqli_num_rows($result);
?>