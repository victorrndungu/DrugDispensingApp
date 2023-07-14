<?php
require("EasyDawa.php");

// Function to sanitize input data to prevent SQL injection
function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "delete") {
    $PATIENT_ID = sanitize($_POST["PATIENT_ID"]);

    $sql = "DELETE FROM patients_info WHERE PATIENT_ID=$PATIENT_ID";

    if ($conn->query($sql) === TRUE) {
        header("Location: displayPatients.php"); // Redirect back to the display page after deletion
        exit();
    } else {
        echo "Error deleting user information: " . $conn->error;
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
    <title>Delete Patient</title>
</head>
<body>
    <h1>Delete Patient</h1>
    <p>Are you sure you want to delete the following patient?</p>
    <p>PATIENT_ID: <?php echo $row["PATIENT_ID"]; ?></p>
    <p>First Name: <?php echo $row["FIRST_NAME"]; ?></p>
    <p>Last Name: <?php echo $row["LAST_NAME"]; ?></p>
    <p>Gender: <?php echo $row["GENDER"]; ?></p>
    <p>Age: <?php echo $row["AGE"]; ?></p>
    <p>Email Address: <?php echo $row["EMAIL_ADDRESS"]; ?></p>

    <form method="post" action="">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="PATIENT_ID" value="<?php echo $row["PATIENT_ID"]; ?>">
        <input type="submit" value="Delete">
    </form>
</body>
</html>
