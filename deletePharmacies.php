<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the unique identifier (PATIENT_ID) from the form submission
    $PHAR_ID = $_POST["PHAR_ID"];

    // Prepare and execute the SQL DELETE statement
    $sql = "DELETE FROM pharmacyinfo WHERE PHAR_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $PHAR_ID);

    if ($stmt->execute()) {
        echo "Pharmacy record deleted successfully.";
    } else {
        echo "Error deleting pharmacy record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

