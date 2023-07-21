<?php
require("EasyDawa.php");

$PHAR_ID = $_POST["PHAR_ID"] ?? null;
$row = null;

if ($PHAR_ID) {
    $sql = "SELECT * FROM pharmacyinfo WHERE PHAR_ID = '$PHAR_ID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pharname = $_POST["pharname"] ?? "";
    $pharphone = $_POST["pharphone"] ?? "";
    $email = $_POST["email"] ?? "";
    $PharAddress = $_POST["PharAddress"] ?? "";
    $contract_ID = $_POST["contract_ID"] ?? "";

    // Update the pharmacy details in the database
    $updateSql = "UPDATE pharmacyinfo SET pharname = '$pharname', pharphone = '$pharphone', email = '$email', PharAddress = '$PharAddress', contract_ID = '$contract_ID' WHERE PHAR_ID = '$PHAR_ID'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Pharmacy details updated successfully.";
    } else {
        echo "Error updating pharmacy details: " . $conn->error;
    }
}

$conn->close();
?>

<form method="post" action="">
    <?php if ($PHAR_ID && isset($row)) : ?>
        <input type="hidden" name="PHAR_ID" value="<?php echo $row["PHAR_ID"]; ?>">
        <label for="pharname">Pharmacy Name:</label>
        <input type="text" name="pharname" value="<?php echo $row["pharname"] ?? ""; ?>"><br>
        <label for="pharphone">Pharmacy Phone:</label>
        <input type="text" name="pharphone" value="<?php echo $row["pharphone"] ?? ""; ?>"><br>
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $row["email"] ?? ""; ?>"><br>
        <label for="PharAddress">Pharmacy Address:</label>
        <input type="text" name="PharAddress" value="<?php echo $row["PharAddress"] ?? ""; ?>"><br>

        <input type="submit" value="Update">
    <?php endif; ?>
    <p>&copy; 2023 EasyDawa. All rights reserved.</p>
</form>
