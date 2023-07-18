<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["ADMIN_ID"]) && isset($_POST["PASSWORDS"])) {
        $ADMIN_ID = $_POST["ADMIN_ID"];
        $PASSWORDS = $_POST["PASSWORDS"];

        $stmt = $conn->prepare("SELECT Admin_Name FROM admin_details WHERE ADMIN_ID = ? AND PASSWORDS = ?");
        $stmt->bind_param("is", $ADMIN_ID, $PASSWORDS);

        $stmt->execute();

        // Bind the result
        $stmt->bind_result($Admin_Name);

        // Check if a matching record is found
        if ($stmt->fetch()) {
            // Successful login, grant access
            // Redirect to the dashboard
            header("Location: adminDash.html");
            exit;
        } else {
            // Invalid credentials, deny access
            echo "Invalid credentials. Please try again.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid request. Please provide both ADMIN_ID and PASSWORDS.";
    }
} else {
    echo "Invalid request method. Only POST requests are allowed.";
}

$conn->close();
?>
