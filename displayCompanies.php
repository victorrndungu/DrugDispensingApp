<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="display.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Helvetica">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Data</title>
</head>

<body>

</body>

</html>

<?php
require("EasyDawa.php");

$sql = "SELECT COMPANY_ID, Company_Name, Company_Phone, Company_Address, Company_Email FROM company_info";
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0) : ?>
    <table border="1">
        <tr>
            <th>Company ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["COMPANY_ID"]; ?></td>
                <td><?php echo $row["Company_Name"]; ?></td>
                <td><?php echo $row["Company_Phone"]; ?></td>
                <td><?php echo $row["Company_Address"]; ?></td>
                <td><?php echo $row["Company_Email"]; ?></td>
                <td>
                    <form method="post" action="editCompanies.php">
                        <input type="hidden" name="COMPANY_ID" value="<?php echo $row["COMPANY_ID"]; ?>">
                        <input type="submit" value="Edit">
                    </form>
                    <form method="post" action="deleteCompanies.php">
                        <input type="hidden" name="COMPANY_ID" value="<?php echo $row["COMPANY_ID"]; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>
<?php else : ?>
    <p>No data found.</p>
<?php endif; ?>

<?php
$conn->close();
?>