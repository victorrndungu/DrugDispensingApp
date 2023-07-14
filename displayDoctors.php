
=======
<?php
require("EasyDawa.php");

$sql = "SELECT DOCTORS_ID, FIRST_NAME, LAST_NAME, SPECIALITY, YRS_OF_EXPERIENCE, EMAIL_ADDRESS FROM patients_info"; 
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0) : ?>
    <table border="1">
        <tr>
            <th>PATIENT_ID</th>
            <th>FIRST_NAME</th>
            <th>LAST_NAME</th>
            <th>GENDER</th>
            <th>AGE</th>
            <th>EMAIL_ADDRESS</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["DOCTORS_ID"]; ?></td>
                <td><?php echo $row["FIRST_NAME"]; ?></td>
                <td><?php echo $row["LAST_NAME"]; ?></td>
                <td><?php echo $row["SPECIALITY"]; ?></td>
                <td><?php echo $row["YES_OF_EXPERIENCE"]; ?></td>
                <td><?php echo $row["EMAIL_ADDRESS"]; ?></td>
                <td>
                    <form method="post" action="editDoctors.php">
                        <input type="hidden" name="DOCTORS_ID" value="<?php echo $row["DOCTORS_ID"]; ?>">
                        <input type="submit" value="Edit">
                    </form>
                    <form method="post" action="deleteDoctors.php">
                        <input type="hidden" name="DOCTORS_ID" value="<?php echo $row["DOCTORS_ID"]; ?>">
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
