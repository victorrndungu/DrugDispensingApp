<?php
require("EasyDawa.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $drug_id = $_POST["drug_id"];
    $drug_name = $_POST["drug_name"];
    $drug_type = $_POST["drug_type"];
    $drug_form = $_POST["drug_form"];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO drug_info (`drug_id`, `drug_name`, `drug_type`, `drug_form`)
            VALUES ('$drug_id', '$drug_name', '$drug_type', '$drug_form')";

    if ($conn->query($sql) === TRUE) {
        echo "New drug added successfully!";
    } else {
        if ($conn->errno === 1062) {
            echo "Error: Drug with ID $drug_id already exists.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>

