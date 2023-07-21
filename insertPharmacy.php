<?php
require("EasyDawa.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $phar_id = $_POST["PHAR_ID"];
    $phar_name = $_POST["PHAR_NAME"];
    $phar_phone = $_POST["PHAR_PHONE"];
    $email = $_POST["EMAIL"];
    $phar_address = $_POST["PHAR_ADDRESS"];
    $passwords = $_POST["PASSWORDS"];

    // Check if PASSWORDS is provided
    if (!empty($passwords)) {
        // Prepare and execute the SQL query
        $sql = "INSERT INTO pharmacyinfo (PHAR_ID, pharname, pharphone, email, PharAddress , PASSWORDS)
                VALUES (?, ?, ?, ?, ? , ?)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind the parameters
            $stmt->bind_param("isisss", $phar_id, $phar_name, $phar_phone, $email, $phar_address, $passwords);


            if ($stmt->execute()) {
                echo "New pharmacy added successfully!";
                 // Redirect to the dashboard
            header("Location: pharmacyDash.html");
            exit;
            } else {
                if ($conn->errno === 1062) {
                    echo "Error: Pharmacy with ID $phar_id already exists.";
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
