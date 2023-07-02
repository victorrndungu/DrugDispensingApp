<?php
require("EasyDawa.php");
$sql= " INSERT INTO `pharmacyinfo` (`PHAR ID`, `pharname`, `pharphone`,
 `email`, `PharAddress`, `Contract_ID`)
  VALUES ('30101015', 'Inkamed Pharmacies', '0733449807', 'inkamedpharmacies@gmail.com',
   '0 Ushirika Towers, Jimbo', '60101015')";

if ($conn->query($sql) ==TRUE) {
    echo " New record created successfully";
} else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}
$conn->close();
?>