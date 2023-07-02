<?php
require("EasyDawa.php");
$sql = "INSERT INTO `patients_info`(`FIRST NAME`, `LAST NAME`, `PATIENT_ID`, `AGE`, `EMAIL ADDRESS`, `GENDER`, `PASSWORDS`) 
VALUES ('Mindy', 'Milano', '10101020','12', 
'harry.milano@gmail.com',
'Female ', 'HarryLano')";
if ($conn->query($sql) ==TRUE) {
    echo " New record created successfully";
} else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}
$conn->close();
?>