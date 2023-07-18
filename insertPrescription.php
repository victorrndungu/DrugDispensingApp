<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $prescription_id = $_POST["prescription_id"];
    $drug_id = $_POST["drug_id"];
    $drug_dosage = $_POST["drug_dosage"];
    $patient_id = $_POST["PATIENT_ID"];
    $doctor_id = $_POST["DOCTORS_ID"];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO prescriptions (prescription_id, drug_id, drug_dosage, PATIENT_ID, DOCTORS_ID)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiisi", $prescription_id, $drug_id, $drug_dosage, $patient_id, $doctor_id);
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0) {
        echo "Prescription added successfully!";
    } else {
        echo "Error adding prescription. Please try again.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request method. Only POST requests are allowed.";
}

// Close the database connection
$conn->close();
?>
