<?php

$servername= "localhost";
$username= "root";
$password= "";
$dbname= "easydawa";
//Create Connection
$conn = mysqli_connect($servername,$username,$password,$dbname);
 //Check connection
 if (!$conn) {
    die ("Connection failed: ". mysqli_connect_error());
}
else{
    echo "Connected";
}
$sql = "CREATE TABLE PharmacyInfo (
    pharid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pharname VARCHAR(30) NOT NULL,
    pharphone INT(10) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if (mysqli_query($conn, $sql)) {
      echo "Table created successfully";
    } else {
      echo "Error creating table: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
    ?>