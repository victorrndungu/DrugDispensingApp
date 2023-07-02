<?php
require("EasyDawa.php");
$sql= " INSERT INTO `company_info` (`COMPANY ID`, `Company_Name`, `Company_Phone`, `Company_Address`, `Company_Email`, `Contract_ID`)
 VALUES ('40101015', 'Kauffmann Pharmaceuticals', '0701678540', '77 Industry Rd.', 'kauffmannpharmaceuticals@gmail.com', '60101015')";
 if ($conn->query($sql) ==TRUE) {
    echo " New record created successfully";
} else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}
$conn->close();
?>