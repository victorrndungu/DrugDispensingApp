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

$sql = "SELECT PHAR_ID, pharname, pharphone, email, PharAddress FROM pharmacyinfo"; 
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0) : ?>
    <table border="1">
        <tr>
            <th>Pharmacy ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["PHAR_ID"]; ?></td>
                <td><?php echo $row["pharname"]; ?></td>
                <td><?php echo $row["pharphone"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["PharAddress"]; ?></td>
                <td>
                    <form method="post" action="editPharmacies.php">
                        <input type="hidden" name="PHAR_ID" value="<?php echo $row["PHAR_ID"]; ?>">
                        <input type="submit" value="Edit">
                    </form>
                    <form method="post" action="deletePharmacies.php">
                        <input type="hidden" name="PHAR_ID" value="<?php echo $row["PHAR_ID"]; ?>">
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

