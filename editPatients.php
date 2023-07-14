<?php
require("EasyDawa.php");

$PATIENT_ID = $_POST["PATIENT_ID"] ?? null;
$row = null;

if ($PATIENT_ID) {
    $sql = "SELECT * FROM patients_info WHERE PATIENT_ID = '$PATIENT_ID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $FIRST_NAME = $_POST["FIRST_NAME"] ?? "";
    $LAST_NAME = $_POST["LAST_NAME"] ?? "";
    $GENDER = $_POST["GENDER"] ?? "";
    $AGE = $_POST["AGE"] ?? "";
    $EMAIL_ADDRESS = $_POST["EMAIL_ADDRESS"] ?? "";

    // Update the patient details in the database
    $updateSql = "UPDATE patients_info SET FIRST_NAME = '$FIRST_NAME', LAST_NAME = '$LAST_NAME', GENDER = '$GENDER', AGE = '$AGE', EMAIL_ADDRESS = '$EMAIL_ADDRESS' WHERE PATIENT_ID = '$PATIENT_ID'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Patient details updated successfully.";
    } else {
        echo "Error updating patient details: " . $conn->error;
    }
}

$conn->close();
?>

<form method="post" action="">
    <?php if ($PATIENT_ID && isset($row)) : ?>
        <input type="hidden" name="PATIENT_ID" value="<?php echo $row["PATIENT_ID"]; ?>">
        <label for="FIRST_NAME">First Name:</label>
        <input type="text" name="FIRST_NAME" value="<?php echo $row["FIRST_NAME"] ?? ""; ?>"><br>
        <label for="LAST_NAME">Last Name:</label>
        <input type="text" name="LAST_NAME" value="<?php echo $row["LAST_NAME"] ?? ""; ?>"><br>
        <label for="GENDER">Gender:</label>
        <input type="text" name="GENDER" value="<?php echo $row["GENDER"] ?? ""; ?>"><br>
        <label for="AGE">Age:</label>
        <input type="text" name="AGE" value="<?php echo $row["AGE"] ?? ""; ?>"><br>
        <label for="EMAIL_ADDRESS">Email Address:</label>
        <input type="text" name="EMAIL_ADDRESS" value="<?php echo $row["EMAIL_ADDRESS"] ?? ""; ?>"><br>

        <input type="submit" value="Update">
    <?php endif; ?>
</form>

