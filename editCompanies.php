<?php
require("EasyDawa.php");

$COMPANY_ID = $_POST["COMPANY_ID"] ?? null;
$row = null;

if ($COMPANY_ID) {
    $sql = "SELECT * FROM company_info WHERE COMPANY_ID = '$COMPANY_ID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Company_Name = $_POST["Company_Name"] ?? "";
    $Company_Phone = $_POST["Company_Phone"] ?? "";
    $Company_Address = $_POST["Company_Address"] ?? "";
    $Company_Email = $_POST["Company_Email"] ?? "";
    $Contract_ID = $_POST["Contract_ID"] ?? "";

    // Update the company details in the database
    $updateSql = "UPDATE company_info SET Company_Name = '$Company_Name', Company_Phone = '$Company_Phone', Company_Address = '$Company_Address', Company_Email = '$Company_Email', Contract_ID = '$Contract_ID' WHERE COMPANY_ID = '$COMPANY_ID'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Company details updated successfully.";
    } else {
        echo "Error updating company details: " . $conn->error;
    }
}

$conn->close();
?>

<form method="post" action="">
    <?php if ($COMPANY_ID && isset($row)) : ?>
        <input type="hidden" name="COMPANY_ID" value="<?php echo $row["COMPANY_ID"]; ?>">
        <label for="Company_Name">Company Name:</label>
        <input type="text" name="Company_Name" value="<?php echo $row["Company_Name"] ?? ""; ?>"><br>
        <label for="Company_Phone">Company Phone:</label>
        <input type="text" name="Company_Phone" value="<?php echo $row["Company_Phone"] ?? ""; ?>"><br>
        <label for="Company_Address">Company Address:</label>
        <input type="text" name="Company_Address" value="<?php echo $row["Company_Address"] ?? ""; ?>"><br>
        <label for="Company_Email">Company Email:</label>
        <input type="text" name="Company_Email" value="<?php echo $row["Company_Email"] ?? ""; ?>"><br>
        <label for="Contract_ID">Contract ID:</label>
        <input type="text" name="Contract_ID" value="<?php echo $row["Contract_ID"] ?? ""; ?>"><br>

        <input type="submit" value="Update">
    <?php endif; ?>
</form>
