<?php
require("EasyDawa.php");
$sql = "INSERT INTO `drug_info` (`drug_id`, `medicine_type`, `form`)
 VALUES ('1001', 'Analgesic', 'Tablet') ";
 if ($conn->query($sql) ==TRUE) {
    echo " New record created successfully";
} else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}
$conn->close();
?>
