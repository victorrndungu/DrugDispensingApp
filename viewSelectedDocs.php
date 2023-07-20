<?php
require("EasyDawa.php");
session_start();

if (!isset($_SESSION["patient_id"])) {
    header("Location: patientLogin.html");
    exit;
}

$loggedInPatientID = $_SESSION["patient_id"];

$sql = "SELECT PATIENT_ID, DOCTORS_ID FROM selected_doctor WHERE PATIENT_ID = $loggedInPatientID";
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0) : ?>
    <table border="1">
        <tr>
            <th>PATIENT_ID</th>
            <th>DOCTORS_ID</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["PATIENT_ID"]; ?></td>
                <td><?php echo $row["DOCTORS_ID"]; ?></td>
                <td>
                    <form method="post" action="deleteSelectedDoctor.php">
                        <input type="hidden" name="PATIENT_ID" value="<?php echo $row["PATIENT_ID"]; ?>">
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
