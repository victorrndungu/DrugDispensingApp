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
</html>
<?php
require("EasyDawa.php");

$sql = "SELECT drug_id, drug_name, drug_type, drug_form FROM drug_info"; 
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0) : ?>
    <table border="1">
        <tr>
            <th>Drug ID</th>
            <th>Drug Name</th>
            <th>Drug Type</th>
            <th>Drug Form</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["drug_id"]; ?></td>
                <td><?php echo $row["drug_name"]; ?></td>
                <td><?php echo $row["drug_type"]; ?></td>
                <td><?php echo $row["drug_form"]; ?></td>
                <td>
                    <form method="post" action="editDrugs.php">
                        <input type="hidden" name="drug_id" value="<?php echo $row["drug_id"]; ?>">
                        <input type="submit" value="Edit">
                    </form>
                    <form method="post" action="deleteDrugs.php">
                        <input type="hidden" name="drug_id" value="<?php echo $row["drug_id"]; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>
<?php else : ?>
    <p>No data found.</p>
<?php endif; ?>
<p>&copy; 2023 EasyDawa. All rights reserved.</p>
<?php
$conn->close();
?>
