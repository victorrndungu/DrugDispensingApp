<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the unique identifier (Supervisor_ID) from the form submission
    $Supervisor_ID = $_POST["Supervisor_ID"];

    // Prepare and execute the SQL DELETE statement
    $sql = "DELETE FROM supervisor_details WHERE Supervisor_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Supervisor_ID);

    if ($stmt->execute()) {
        echo "Supervisor record deleted successfully.";
    } else {
        echo "Error deleting supervisor record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
