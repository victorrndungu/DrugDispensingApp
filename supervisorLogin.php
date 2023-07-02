<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Supervisor_ID"]) && isset($_POST["PASSWORDS"])) {
        $Supervisor_ID = $_POST["Supervisor_ID"];
        $PASSWORDS = $_POST["PASSWORDS"];

        $stmt = $conn->prepare("SELECT FIRST_NAME, LAST_NAME FROM supervisor_details WHERE Supervisor_ID = ? AND PASSWORDS = ?");
        $stmt->bind_param("is", $Supervisor_ID, $PASSWORDS);

        $stmt->execute();

        // Bind the result
        $stmt->bind_result($FIRST_NAME, $LAST_NAME);
        // Check if a matching record is found

        if ($stmt->fetch()) {
            // Successful login, grant access
            echo "Welcome " . $FIRST_NAME . " " . $LAST_NAME;
        } else {
            // Invalid credentials, deny access
            echo "Invalid credentials. Please try again.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid request. Please provide both COMPANY_ID and PASSWORDS.";
    }
} else {
    echo "Invalid request method. Only POST requests are allowed.";
}

$conn->close();
?>
