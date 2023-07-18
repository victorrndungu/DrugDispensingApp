<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["PHAR_ID"]) && isset($_POST["PASSWORDS"])) {
        $PHAR_ID = $_POST["PHAR_ID"];
        $PASSWORDS = $_POST["PASSWORDS"];

        // Prepare and execute the SQL query
        $stmt = $conn->prepare("SELECT pharname FROM pharmacyinfo WHERE PHAR_ID = ? AND PASSWORDS = ?");
        $stmt->bind_param("is", $PHAR_ID, $PASSWORDS);

        $stmt->execute();

        // Bind the result
        $stmt->bind_result($phar_name);

        // Check if a matching record is found
        if ($stmt->fetch()) {
            // Successful login, grant access
            echo "Welcome " . $phar_name;
        } else {
            // Invalid credentials, deny access
            echo "Invalid credentials. Please try again.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid request. Please provide both PHAR_ID and PASSWORDS.";
    }
} else {
    echo "Invalid request method. Only POST requests are allowed.";
}

$conn->close();
?>
