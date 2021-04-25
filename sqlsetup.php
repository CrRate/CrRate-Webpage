<?php
    $db = mysqli_connect("localhost", "root", "", "crabDB");
    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
  
  // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS crabDB";
    if (mysqli_query($db, $sql)) {
        #echo "Database created successfully";
    } else {
        echo "Error creating database: " . mysqli_error($db);
    }

    $sql = "CREATE TABLE IF NOT EXISTS images (
        id INT AUTO_INCREMENT PRIMARY KEY,
        image BLOB NOT NULL,
        image_path VARCHAR(255) NOT NULL,
        description VARCHAR(255) NOT NULL,
        rating INT(4)
        )";
    #$sql = "DROP TABLE images";
    
    if (mysqli_query($db, $sql)) {
        #echo "Table images created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($db);
    }
    // Create database connection
    #$db = mysqli_connect("localhost", "root", "", "crabDB");
?>