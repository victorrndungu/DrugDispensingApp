<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the unique identifier (drug_id) from the form submission
    $drug_id = $_POST["drug_id"];

    // Prepare and execute the SQL DELETE statement
    $sql = "DELETE FROM drug_info WHERE drug_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $drug_id);

    if ($stmt->execute()) {
        echo "Drug record deleted successfully.";
    } else {
        echo "Error deleting drug record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
