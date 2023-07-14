
=======
<?php
require("EasyDawa.php");

$sql = "SELECT PHAR_ID, pharname, pharphone, email, PharAddress, Contract_ID FROM pharmacyinfo"; 
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
            <th>Contract ID</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["PHAR_ID"]; ?></td>
                <td><?php echo $row["pharmname"]; ?></td>
                <td><?php echo $row["pharmphone"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["PharAddress"]; ?></td>
                <td><?php echo $row["Contract_ID"]; ?></td>
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

<?php
$conn->close();
?>
>>>>>>> 48aeca46151e3644c40187df7e33b7408ad8e948
