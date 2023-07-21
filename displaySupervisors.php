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

$sql = "SELECT Supervisor_ID, FIRST_NAME, LAST_NAME, Phone, Email_Address FROM supervisor_details";
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0) : ?>
    <table border="1">
        <tr>
            <th>Supervisor ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Email Address</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["Supervisor_ID"]; ?></td>
                <td><?php echo $row["FIRST_NAME"]; ?></td>
                <td><?php echo $row["LAST_NAME"]; ?></td>
                <td><?php echo $row["Phone"]; ?></td>
                <td><?php echo $row["Email_Address"]; ?></td>
                <td>
                    <form method="post" action="editSupervisors.php">
                        <input type="hidden" name="Supervisor_ID" value="<?php echo $row["Supervisor_ID"]; ?>">
                        <input type="submit" value="Edit">
                    </form>
                    <form method="post" action="deleteSupervisors.php">
                        <input type="hidden" name="Supervisor_ID" value="<?php echo $row["Supervisor_ID"]; ?>">
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
