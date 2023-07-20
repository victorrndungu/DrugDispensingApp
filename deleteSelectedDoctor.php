<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the unique identifiers (PATIENT_ID and DOCTORS_ID) from the form submission
    $PATIENT_ID = $_POST["PATIENT_ID"];
    $DOCTORS_ID = $_POST["DOCTORS_ID"];

    // Prepare and execute the SQL DELETE statement
    $sql = "DELETE FROM selected_doctor WHERE PATIENT_ID = ? AND DOCTORS_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $PATIENT_ID, $DOCTORS_ID);

    if ($stmt->execute()) {
        echo "Selected doctor record deleted successfully.";
    } else {
        echo "Error deleting selected doctor record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
