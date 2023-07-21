<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["PATIENT_ID"])) {
        $PATIENT_ID = $_POST["PATIENT_ID"];

        // Prepare and execute the SQL query to fetch the prescription details
        $stmt = $conn->prepare("SELECT * FROM prescriptions WHERE PATIENT_ID = ?");
        $stmt->bind_param("i", $PATIENT_ID);

        $stmt->execute();

        // Bind the result
        $stmt->bind_result($prescription_id, $drug_id, $drug_dosage, $patient_id, $doctor_id);

        // Check if a matching record is found
        if ($stmt->fetch()) {
            // Display the prescription details
            echo "<h1>Prescription Details</h1>";
            echo "<p>Prescription ID: " . $prescription_id . "</p>";
            echo "<p>Drug ID: " . $drug_id . "</p>";
            echo "<p>Drug Dosage: " . $drug_dosage . "</p>";
            echo "<p>Patient ID: " . $patient_id . "</p>";
            echo "<p>Doctor ID: " . $doctor_id . "</p>";
        } else {
            // No prescription found for the patient
            echo "<p>No prescription found for the patient.</p>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid request. Please provide PATIENT_ID.";
    }
} else {
    echo "Invalid request method. Only POST requests are allowed.";
}

$conn->close();
?>
<p>&copy; 2023 EasyDawa. All rights reserved.</p>
<html>
<head>
    <title>View Patients</title>
    <link rel="stylesheet" href="viewPatients.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Helvetica">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
</html>
