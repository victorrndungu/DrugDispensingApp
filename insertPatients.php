<?php
require("EasyDawa.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $patient_id = $_POST["PATIENT_ID"];
    $first_name = $_POST["FIRST_NAME"];
    $last_name = $_POST["LAST_NAME"];
    $gender = $_POST["GENDER"];
    $age = $_POST["AGE"];
    $email = $_POST["EMAIL_ADDRESS"];
    $password = $_POST["PASSWORDS"];

    // Prepare the SQL statement with parameter placeholders
    $sql = "INSERT INTO patients_info (PATIENT_ID, FIRST_NAME, LAST_NAME, GENDER, AGE, EMAIL_ADDRESS, PASSWORDS)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind the parameters to the statement
        $stmt->bind_param("isssiss", $patient_id, $first_name, $last_name, $gender, $age, $email, $password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New patient added successfully!";
        } else {
            if ($conn->errno === 1062) {
                echo "Error: Patient with ID $patient_id already exists.";
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
