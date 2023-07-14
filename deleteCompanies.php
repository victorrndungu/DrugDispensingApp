<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the unique identifier (COMPANY_ID) from the form submission
    $COMPANY_ID = $_POST["COMPANY_ID"];

    // Prepare and execute the SQL DELETE statement
    $sql = "DELETE FROM company_info WHERE COMPANY_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $COMPANY_ID);

    if ($stmt->execute()) {
        echo "Company record deleted successfully.";
    } else {
        echo "Error deleting company record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

