<?php
require("EasyDawa.php");

// Fetch the patient details from the database and display them in an HTML table
$sql = "SELECT * FROM patients_info";
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0) : ?>
    <table border="1">
        <tr>
            <th>Patient ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Email Address</th>
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
                    <form method="post" action="selectedPatientPrescription.php">
                        <input type="hidden" name="PATIENT_ID" value="<?php echo $row["PATIENT_ID"]; ?>">
                        <input type="submit" value="Select">
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


