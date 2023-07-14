<?php
require("EasyDawa.php");
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $doctors_id = $_POST["DOCTORS_ID"];
    $first_name = $_POST["FIRST_NAME"];
    $last_name = $_POST["LAST_NAME"];
    $speciality = $_POST["SPECIALITY"];
    $yrs_of_experience = $_POST["YRS_OF_EXPERIENCE"];
    $email = $_POST["EMAIL_ADDRESS"];
    $password = $_POST["PASSWORDS"];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO doctors_info (DOCTORS_ID, FIRST_NAME, LAST_NAME, SPECIALITY, YRS_OF_EXPERIENCE, EMAIL_ADDRESS, PASSWORDS)
            VALUES ('$doctors_id', '$first_name', '$last_name', '$speciality', '$yrs_of_experience', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New doctor added successfully!";
    } else {
        if ($conn->errno === 1062) {
            echo "Error: Doctor with ID $doctors_id already exists.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>

