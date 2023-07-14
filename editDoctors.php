<?php
require("EasyDawa.php");

$DOCTORS_ID = $_POST["DOCTORS_ID"] ?? null;
$row = null;

if ($DOCTORS_ID) {
    $sql = "SELECT * FROM doctors_info WHERE DOCTORS_ID = '$DOCTORS_ID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $FIRST_NAME = $_POST["FIRST_NAME"] ?? "";
    $LAST_NAME = $_POST["LAST_NAME"] ?? "";
    $SPECIALITY = $_POST["SPECIALITY"] ?? "";
    $YRS_OF_EXPERIENCE = $_POST["YRS_OF_EXPERIENCE"] ?? "";
    $EMAIL_ADDRESS = $_POST["EMAIL_ADDRESS"] ?? "";

    // Update the doctor details in the database
    $updateSql = "UPDATE doctors_info SET FIRST_NAME = '$FIRST_NAME', LAST_NAME = '$LAST_NAME', SPECIALITY = '$SPECIALITY', YRS_OF_EXPERIENCE = '$YRS_OF_EXPERIENCE', EMAIL_ADDRESS = '$EMAIL_ADDRESS' WHERE DOCTORS_ID = '$DOCTORS_ID'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Doctor details updated successfully.";
    } else {
        echo "Error updating doctor details: " . $conn->error;
    }
}

$conn->close();
?>

<form method="post" action="">
    <?php if ($DOCTORS_ID && isset($row)) : ?>
        <input type="hidden" name="DOCTORS_ID" value="<?php echo $row["DOCTORS_ID"]; ?>">
        <label for="FIRST_NAME">First Name:</label>
        <input type="text" name="FIRST_NAME" value="<?php echo $row["FIRST_NAME"] ?? ""; ?>"><br>
        <label for="LAST_NAME">Last Name:</label>
        <input type="text" name="LAST_NAME" value="<?php echo $row["LAST_NAME"] ?? ""; ?>"><br>
        <label for="SPECIALITY">Speciality:</label>
        <input type="text" name="SPECIALITY" value="<?php echo $row["SPECIALITY"] ?? ""; ?>"><br>
        <label for="YRS_OF_EXPERIENCE">Years of Experience:</label>
        <input type="text" name="YRS_OF_EXPERIENCE" value="<?php echo $row["YRS_OF_EXPERIENCE"] ?? ""; ?>"><br>
        <label for="EMAIL_ADDRESS">Email Address:</label>
        <input type="text" name="EMAIL_ADDRESS" value="<?php echo $row["EMAIL_ADDRESS"] ?? ""; ?>"><br>

        <input type="submit" value="Update">
    <?php endif; ?>
</form>
