<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["DOCTORS_ID"]) && isset($_POST["PASSWORDS"])) {
        $DOCTORS_ID = $_POST["DOCTORS_ID"];
        $PASSWORDS = $_POST["PASSWORDS"];

        $stmt = $conn->prepare("SELECT FIRST_NAME, LAST_NAME FROM doctors_info WHERE DOCTORS_ID = ? AND PASSWORDS = ?");
        $stmt->bind_param("is", $DOCTORS_ID, $PASSWORDS);

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
        echo "Invalid request. Please provide both DOCTORS_ID and PASSWORDS.";
    }
} else {
    echo "Invalid request method. Only POST requests are allowed.";
}

$conn->close();
?>
