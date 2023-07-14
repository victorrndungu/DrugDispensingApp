<?php
require("EasyDawa.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $supervisor_id = $_POST["Supervisor_ID"];
    $first_name = $_POST["FIRST_NAME"];
    $last_name = $_POST["LAST_NAME"];
    $phone = $_POST["Phone"];
    $email_address = $_POST["Email_Address"];
    $contract_id = $_POST["Contract_ID"];
    $passwords = $_POST["PASSWORDS"];

    // Check if PASSWORDS is provided
    if (!empty($passwords)) {
        // Prepare and execute the SQL query
        $sql = "INSERT INTO supervisor_details (Supervisor_ID, FIRST_NAME, LAST_NAME, Phone, Email_Address, Contract_ID, PASSWORDS)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind the parameters
            $stmt->bind_param("issssss", $supervisor_id, $first_name, $last_name, $phone, $email_address, $contract_id, $passwords);

            if ($stmt->execute()) {
                echo "New supervisor added successfully!";
            } else {
                if ($conn->errno === 1062) {
                    echo "Error: Supervisor with ID $supervisor_id already exists.";
                } else {
                    echo "Error: " . $stmt->error;
                }
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: Password is required.";
    }
}

// Close the database connection
$conn->close();
?>
