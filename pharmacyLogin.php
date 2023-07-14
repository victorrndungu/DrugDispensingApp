<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["PHAR_ID"]) && isset($_POST["PASSWORDS"])) {
        $PHAR_ID = $_POST["PHAR_ID"];
        $PASSWORDS = $_POST["PASSWORDS"];

        // Prepare and bind the SQL query with parameters
        $stmt = $conn->prepare("SELECT pharname, PASSWORDS FROM pharmacyinfo WHERE PHAR_ID = ?");
        $stmt->bind_param("i", $PHAR_ID);

        $stmt->execute();

        // Bind the result
        $stmt->bind_result($pharname, $hashedPassword);

        // Check if a matching record is found
        if ($stmt->fetch()) {
            // Verify the password
            if (password_verify($PASSWORDS, $hashedPassword)) {
                // Successful login, grant access
                echo "Welcome " . $pharname;
            } else {
                // Invalid credentials, deny access
                echo "Invalid credentials. Please try again.";
            }
        } else {
            // Invalid credentials, deny access
            echo "Invalid credentials. Please try again.";
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid request. Please provide both PHAR_ID and PASSWORDS.";
    }
} else {
    echo "Invalid request method. Only POST requests are allowed.";
}
?>
