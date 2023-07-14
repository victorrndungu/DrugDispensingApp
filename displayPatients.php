
=======
<?php
require("EasyDawa.php");

$sql = "SELECT PATIENT_ID, FIRST_NAME, LAST_NAME, GENDER, AGE, EMAIL_ADDRESS FROM patients_info"; 
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
                <td><?php echo $row["PATIENT_ID"]; ?></td>
                <td><?php echo $row["FIRST_NAME"]; ?></td>
                <td><?php echo $row["LAST_NAME"]; ?></td>
                <td><?php echo $row["GENDER"]; ?></td>
                <td><?php echo $row["AGE"]; ?></td>
                <td><?php echo $row["EMAIL_ADDRESS"]; ?></td>
                <td>
                    <form method="post" action="editPatients.php">
                        <input type="hidden" name="PATIENT_ID" value="<?php echo $row["PATIENT_ID"]; ?>">
                        <input type="submit" value="Edit">
                    </form>
                    <form method="post" action="deletePatients.php">
                        <input type="hidden" name="PATIENT_ID" value="<?php echo $row["PATIENT_ID"]; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>
    <!-- Display the HTML form with pre-filled patient details for editing -->
<form method="post" action="">
    <input type="hidden" name="PATIENT_ID" value="<?php echo $patientID; ?>">
    <label for="FIRST_NAME">First Name:</label>
    <input type="text" name="FIRST_NAME" value="<?php echo $FIRST_NAME; ?>"><br>
    <label for="LAST_NAME">Last Name:</label>
    <input type="text" name="LAST_NAME" value="<?php echo $LAST_NAME; ?>"><br>
    <label for="GENDER">Gender:</label>
    <input type="text" name="GENDER" value="<?php echo $GENDER; ?>"><br>
    <label for="AGE">Age:</label>
    <input type="text" name="AGE" value="<?php echo $AGE; ?>"><br>
    <label for="EMAIL_ADDRESS">Email Address:</label>
    <input type="text" name="EMAIL_ADDRESS" value="<?php echo $EMAIL_ADDRESS; ?>"><br>

    <input type="submit" value="Update">
</form>

<?php else : ?>
    <p>No data found.</p>
<?php endif; ?>

<?php
$conn->close();
?>
>>>>>>> 48aeca46151e3644c40187df7e33b7408ad8e948
