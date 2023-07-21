<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="insertSupervisors.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Helvetica">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Data</title>
</head>
</html>
<?php
require("EasyDawa.php");

$Supervisor_ID = $_POST["Supervisor_ID"] ?? null;
$row = null;

if ($Supervisor_ID) {
    $sql = "SELECT * FROM supervisor_details WHERE Supervisor_ID = '$Supervisor_ID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $FIRST_NAME = $_POST["FIRST_NAME"] ?? "";
    $LAST_NAME = $_POST["LAST_NAME"] ?? "";
    $Phone = $_POST["Phone"] ?? "";
    $Email_Address = $_POST["Email_Address"] ?? "";

    // Update the supervisor details in the database
    $updateSql = "UPDATE supervisor_details SET FIRST_NAME = '$FIRST_NAME', LAST_NAME = '$LAST_NAME', Phone = '$Phone', Email_Address = '$Email_Address' WHERE Supervisor_ID = '$Supervisor_ID'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Supervisor details updated successfully.";
    } else {
        echo "Error updating supervisor details: " . $conn->error;
    }
}

$conn->close();
?>

<form method="post" action="">
    <?php if ($Supervisor_ID && isset($row)) : ?>
        <input type="hidden" name="Supervisor_ID" value="<?php echo $row["Supervisor_ID"]; ?>">
        <label for="FIRST_NAME">First Name:</label>
        <input type="text" name="FIRST_NAME" value="<?php echo $row["FIRST_NAME"] ?? ""; ?>"><br>
        <label for="LAST_NAME">Last Name:</label>
        <input type="text" name="LAST_NAME" value="<?php echo $row["LAST_NAME"] ?? ""; ?>"><br>
        <label for="Phone">Phone:</label>
        <input type="text" name="Phone" value="<?php echo $row["Phone"] ?? ""; ?>"><br>
        <label for="Email_Address">Email Address:</label>
        <input type="text" name="Email_Address" value="<?php echo $row["Email_Address"] ?? ""; ?>"><br>
        

        <input type="submit" value="Update">
    <?php endif; ?>
</form>

