<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="insertCompanies.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Helvetica">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Data</title>
</head>
</html>
<?php
require("EasyDawa.php");

$drug_id = $_POST["drug_id"] ?? null;
$row = null;

if ($drug_id) {
    $sql = "SELECT * FROM drug_info WHERE drug_id = '$drug_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $drug_name = $_POST["drug_name"] ?? "";
    $drug_type = $_POST["drug_type"] ?? "";
    $drug_form = $_POST["drug_form"] ?? "";

    // Update the drug details in the database
    $updateSql = "UPDATE drug_info SET drug_name = '$drug_name', drug_type = '$drug_type', drug_form = '$drug_form' WHERE drug_id = '$drug_id'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Drug details updated successfully.";
    } else {
        echo "Error updating drug details: " . $conn->error;
    }
}

$conn->close();
?>

<form method="post" action="">
    <?php if ($drug_id && isset($row)) : ?>
        <input type="hidden" name="drug_id" value="<?php echo $row["drug_id"]; ?>">
        <label for="drug_name">Drug Name:</label>
        <input type="text" name="drug_name" value="<?php echo $row["drug_name"] ?? ""; ?>"><br>
        <label for="drug_type">Drug Type:</label>
        <input type="text" name="drug_type" value="<?php echo $row["drug_type"] ?? ""; ?>"><br>
        <label for="drug_form">Drug Form:</label>
        <input type="text" name="drug_form" value="<?php echo $row["drug_form"] ?? ""; ?>"><br>

        <input type="submit" value="Update">
    <?php endif; ?>
</form>
