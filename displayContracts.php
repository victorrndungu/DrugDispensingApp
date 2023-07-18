<?php
require("EasyDawa.php");

$sql = "SELECT Contract_ID, Contract_Start_Date, Contract_End_Date, PHAR_ID, COMPANY_ID FROM contract_info"; 
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0) : ?>
    <table border="1">
        <tr>
            <th>Contract ID</th>
            <th>Contract Start Date</th>
            <th>Contract End Date</th>
            <th>PHAR ID</th>
            <th>COMPANY ID</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["Contract_ID"]; ?></td>
                <td><?php echo $row["Contract_Start_Date"]; ?></td>
                <td><?php echo $row["Contract_End_Date"]; ?></td>
                <td><?php echo $row["PHAR_ID"]; ?></td>
                <td><?php echo $row["COMPANY_ID"]; ?></td>
                <td>
                    <form method="post" action="editContracts.php">
                        <input type="hidden" name="Contract_ID" value="<?php echo $row["Contract_ID"]; ?>">
                        <input type="submit" value="Edit">
                    </form>
                    <form method="post" action="deleteContracts.php">
                        <input type="hidden" name="Contract_ID" value="<?php echo $row["Contract_ID"]; ?>">
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
