<?php
require("EasyDawa.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize the form data
    $PATIENT_ID = $_POST["PATIENT_ID"];
    $FIRST_NAME = $_POST["FIRST_NAME"];
    $LAST_NAME = $_POST["LAST_NAME"];
    $GENDER = $_POST["GENDER"];
    $AGE = $_POST["AGE"];
    $EMAIL_ADDRESS = $_POST["EMAIL_ADDRESS"];
    // Retrieve other necessary form data

    // Update the patient details in the database using an SQL UPDATE query

    // Redirect back to the original page after successful update
    header("Location: displayPatients.php");
    exit();
} else {
    // Display the form with pre-filled patient details for editing
    if (isset($_GET["PATIENT_ID"])) {
        $patientID = $_GET["PATIENT_ID"];
        // Fetch the patient details from the database based on the ID
        // Pre-fill the form fields with the fetched details
        $FIRST_NAME = ""; // Replace with the fetched first name
        $LAST_NAME = ""; // Replace with the fetched last name
        $GENDER = ""; // Replace with the fetched gender
        $AGE = ""; // Replace with the fetched age
        $EMAIL_ADDRESS = ""; // Replace with the fetched email address
    } else {
        echo "Invalid patient ID.";
    }
}

$conn->close();
?>


