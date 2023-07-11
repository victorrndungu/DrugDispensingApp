<?php
require("EasyDawa.php");
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $company_id = $_POST["COMPANY_ID"];
    $company_name = $_POST["Company_Name"];
    $company_phone = $_POST["Company_Phone"];
    $company_address = $_POST["Company_Address"];
    $company_email = $_POST["Company_Email"];
    $contract_id = $_POST["Contract_ID"];
    $password = $_POST["PASSWORDS"];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO company_info (`COMPANY_ID`, `Company_Name`, `Company_Phone`, `Company_Address`, `Company_Email`, `Contract_ID`, `PASSWORDS`)
            VALUES ('$company_id', '$company_name', '$company_phone', '$company_address', '$company_email', '$contract_id', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New company added successfully!";
    } else {
        if ($conn->errno === 1062) {
            echo "Error: Company with ID $company_id already exists.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>
