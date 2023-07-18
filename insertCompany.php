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
    $password = $_POST["PASSWORDS"];

    // Prepare and execute the SQL query to insert the new company
    $insertSql = "INSERT INTO company_info (`COMPANY_ID`, `Company_Name`, `Company_Phone`, `Company_Address`, `Company_Email`,, `PASSWORDS`)
                  VALUES ('$company_id', '$company_name', '$company_phone', '$company_address', '$company_email', '$password')";

    if ($conn->query($insertSql) === TRUE) {
        echo "New company added successfully!";
    } else {
        if ($conn->errno === 1062) {
            echo "Error: Company with ID $company_id already exists.";
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
        exit;
    }

    // Check if the login is successful
    $loginSql = "SELECT Company_Name FROM company_info WHERE COMPANY_ID = '$company_id' AND PASSWORDS = '$password'";
    $result = $conn->query($loginSql);

    if ($result->num_rows > 0) {
        // Successful login, grant access
        // Redirect to the dashboard
        header("Location: companyDash.html");
        exit;
    } else {
        // Invalid credentials, deny access
        echo "Invalid credentials. Please try again.";
    }

    // Close the database connection
    $conn->close();
}
?>