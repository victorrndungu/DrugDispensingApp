<?php
require("EasyDawa.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $supervisor_id = $_POST["Supervisor_id"];
    $first_name = $_POST["FIRST_NAME"];
    $last_name = $_POST["LAST_NAME"];
    $phone = $_POST["Phone"];
    $email_address = $_POST["Email_Address"];
    $password = $_POST["PASSWORDS"];

    // Prepare and execute the SQL query to insert the new supervisor
    $insertSql = "INSERT INTO supervisor_details (`Supervisor_id`, `FIRST_NAME`, `LAST_NAME`, `Phone`, `Email_Address`, `PASSWORDS`)
                  VALUES ('$supervisor_id', '$first_name', '$last_name', '$phone', '$email_address', '$password')";

    if ($conn->query($insertSql) === TRUE) {
        echo "New supervisor added successfully!";
    } else {
        if ($conn->errno === 1062) {
            echo "Error: Supervisor with ID $supervisor_id already exists.";
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
        exit;
    }

    // Check if the login is successful
    $loginSql = "SELECT Supervisor_id FROM supervisor_details WHERE Supervisor_id = '$supervisor_id' AND PASSWORDS = '$password'";
    $result = $conn->query($loginSql);

    if ($result->num_rows > 0) {
        // Successful login, grant access
        // Redirect to the dashboard
        header("Location: supervisorDash.html");
        exit;
    } else {
        // Invalid credentials, deny access
        echo "Invalid credentials. Please try again.";
    }

    // Close the database connection
    $conn->close();
}
?>
