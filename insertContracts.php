<?php
require("EasyDawa.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $contract_id = $_POST["Contract_ID"];
    $contract_start_date = $_POST["Contract_Start_Date"];
    $contract_end_date = $_POST["Contract_End_Date"];
    $phar_id = $_POST["PHAR_ID"];
    $company_id = $_POST["COMPANY_ID"];
    

    // Prepare and execute the SQL query
    $sql = "INSERT INTO contract_info (Contract_ID, Contract_Start_Date, Contract_End_Date, PHAR_ID, COMPANY_ID)
            VALUES ('$contract_id', '$contract_start_date', '$contract_end_date', '$phar_id', '$company_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New contract added successfully!";
    } else {
        if ($conn->errno === 1062) {
            echo "Error Contract with Contract ID $contract_id already exists.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>
