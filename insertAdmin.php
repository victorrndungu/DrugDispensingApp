<?php
require("EasyDawa.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $admin_id = $_POST["ADMIN_ID"];
    $password = $_POST["PASSWORDS"];
    $sql = "INSERT INTO admin_details (ADMIN_ID, PASSWORDS)
    VALUES ('$admin_id','$password')";
if ($conn->query($sql) === TRUE) {
echo "New admin added successfully!";
} else {
if ($conn->errno === 1062) {
    echo "Error: Admin with ID $admin_id already exists.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

// Close the database connection
$conn->close();
}
?>
