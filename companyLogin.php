<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["COMPANY_ID"]) && isset($_POST["PASSWORDS"])) {
        $COMPANY_ID = $_POST["COMPANY_ID"];
        $PASSWORDS = $_POST["PASSWORDS"];

        $stmt = $conn->prepare("SELECT Company_Name FROM company_info WHERE COMPANY_ID = ? AND PASSWORDS = ?");
        $stmt->bind_param("is", $COMPANY_ID, $PASSWORDS);

        $stmt->execute();

        // Bind the result
        $stmt->bind_result($Company_Name);

        // Check if a matching record is found
        if ($stmt->fetch()) {
            // Successful login, grant access
            echo "Welcome " . $Company_Name;
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
