<?php
require("EasyDawa.php");
$sql= "INSERT INTO `doctors_info` (`FIRST NAME`, `LAST NAME`, `DOCTORS ID`, `SPECIALITY`,
 `EMAIL ADDRESS`, `YRS OF EXPERIENCRE`, `PASSWORDS`)
 VALUES ('Ravi', 'Vishkumar', '20101020', 'Radiologist',
  'vishkumarav1@betterhealth.com', '10', 'r@dior@v1p')";

  if ($conn->query($sql) ==TRUE) {
    echo " New record created successfully";
} else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}
$conn->close();
?>