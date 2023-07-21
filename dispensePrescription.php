<?php
require("EasyDawa.php");

$dispensingRecorded = false;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["prescription_id"]) && isset($_POST["drug_id"]) && isset($_POST["dispense_date"]) && isset($_POST["PATIENT_ID"]) && isset($_POST["DOCTORS_ID"])) {
        $prescription_id = $_POST["prescription_id"];
        $drug_id = $_POST["drug_id"];
        $dispense_date = $_POST["dispense_date"];
        $patient_id = $_POST["PATIENT_ID"];
        $doctor_id = $_POST["DOCTORS_ID"];

        // Prepare and execute the SQL query to record the dispensing
        $sql = "INSERT INTO dispersed_drugs_history (prescription_id, drug_id, dispense_date, PATIENT_ID, DOCTORS_ID)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissi", $prescription_id, $drug_id, $dispense_date, $patient_id, $doctor_id);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            $dispensingRecorded = true;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dispense Prescription</title>
</head>
<body>
    <h1>Dispense Prescription</h1>
    <?php if ($dispensingRecorded) : ?>
        <p style="color: green;">Dispensing recorded successfully!</p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="prescription_id">Prescription ID:</label>
        <input type="text" name="prescription_id" required><br>

        <label for="drug_id">Drug ID:</label>
        <input type="text" name="drug_id" required><br>

        <label for="dispense_date">Dispense Date:</label>
        <input type="date" name="dispense_date" required><br>

        <!-- Include the hidden input fields for PATIENT_ID and DOCTORS_ID -->
        <input type="hidden" name="PATIENT_ID" value="<?php echo isset($_POST["PATIENT_ID"]) ? $_POST["PATIENT_ID"] : ''; ?>">
        <input type="hidden" name="DOCTORS_ID" value="<?php echo isset($_POST["DOCTORS_ID"]) ? $_POST["DOCTORS_ID"] : ''; ?>">

        <input type="submit" value="Dispense">
    </form>
</body>
</html>
