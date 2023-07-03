<?php
require("EasyDawa.php"); // Replace with your database connection file

// Function to sanitize input data to prevent SQL injection
function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $FIRST_NAME = sanitize($_POST["FIRST_NAME"]);
    $LAST_NAME = sanitize($_POST["LAST_NAME"]);
    $GENDER = sanitize($_POST["GENDER"]);
    $AGE = sanitize($_POST["AGE"]);
    $EMAIL_ADDRESS = sanitize($_POST["EMAIL_ADDRESS"]);

    // Create the SQL query to insert the new patient into the database
    $sql = "INSERT INTO patients_info (FIRST_NAME, LAST_NAME, GENDER, AGE, EMAIL_ADDRESS) 
            VALUES ('$FIRST_NAME', '$LAST_NAME', '$GENDER', '$AGE', '$EMAIL_ADDRESS')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the addPatient.html page with a success message
        header("Location: addPatient.html?success=true");
        exit();
    } else {
        echo "Error adding new patient: " . $conn->error;
    }
}
?>
