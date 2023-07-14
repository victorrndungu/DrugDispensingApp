<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["PATIENT_ID"]) && isset($_POST["passwords"])) {
        $PATIENT_ID = $_POST["PATIENT_ID"];
        $passwords = $_POST["passwords"];

        $stmt = $conn->prepare("SELECT FIRST_NAME, LAST_NAME FROM patients_info WHERE PATIENT_ID = ? AND passwords = ?");
        $stmt->bind_param("is", $PATIENT_ID, $passwords);

        $stmt->execute();

        // Bind the result
        $stmt->bind_result($first_name, $last_name);

        // Check if a matching record is found
        if ($stmt->fetch()) {
            // Successful login, grant access
            echo "Welcome " . $first_name . " " . $last_name;
        } else {
            // Invalid credentials, deny access
            echo "Invalid credentials. Please try again.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid request. Please provide both PATIENT_ID and passwords.";
    }
} else {
    echo "Invalid request method. Only POST requests are allowed.";
}

$conn->close();
?>
