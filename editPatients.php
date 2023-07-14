<?php
require("EasyDawa.php");

// Function to sanitize input data to prevent SQL injection
function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "edit") {
    $PATIENT_ID = sanitize($_POST["PATIENT_ID"]);
    $FIRST_NAME = sanitize($_POST["FIRST_NAME"]);
    $LAST_NAME = sanitize($_POST["LAST_NAME"]);
    $GENDER = sanitize($_POST["GENDER"]);
    $AGE = sanitize($_POST["AGE"]);
    $EMAIL_ADDRESS = sanitize($_POST["EMAIL_ADDRESS"]);

    $sql = "UPDATE patients_info SET FIRST_NAME='$FIRST_NAME', LAST_NAME='$LAST_NAME', GENDER='$GENDER', AGE='$AGE', EMAIL_ADDRESS='$EMAIL_ADDRESS' WHERE PATIENT_ID=$PATIENT_ID";

    if ($conn->query($sql) === TRUE) {
        header("Location: displayPatients.php"); // Redirect back to the display page after update
        exit();
    } else {
        echo "Error updating user information: " . $conn->error;
    }
}

// Fetch patient data based on the provided ID
if (isset($_GET["PATIENT_ID"])) {
    $PATIENT_ID = sanitize($_GET["PATIENT_ID"]);
    $sql = "SELECT * FROM patients_info WHERE PATIENT_ID=$PATIENT_ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    // Redirect to the display page if no patient ID is provided
    header("Location: displayPatients.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient Information</title>
</head>
<body>
    <h1>Edit Patient Information</h1>
    <form method="post" action="">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="PATIENT_ID" value="<?php echo $row["PATIENT_ID"]; ?>">
        <label for="FIRST_NAME">First Name:</label>
        <input type="text" name="FIRST_NAME" value="<?php echo $row["FIRST_NAME"]; ?>"><br>
        <label for="LAST_NAME">Last Name:</label>
        <input type="text" name="LAST_NAME" value="<?php echo $row["LAST_NAME"]; ?>"><br>
        <label for="GENDER">Gender:</label>
        <input type="text" name="GENDER" value="<?php echo $row["GENDER"]; ?>"><br>
        <label for="AGE">Age:</label>
        <input type="text" name="AGE" value="<?php echo $row["AGE"]; ?>"><br>
        <label for="EMAIL_ADDRESS">Email Address:</label>
        <input type="text" name="EMAIL_ADDRESS" value="<?php echo $row["EMAIL_ADDRESS"]; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
