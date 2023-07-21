<?php
require("EasyDawa.php");

// Check if the session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$patientID = $_SESSION["patient_id"];
$loggedInPatientID = $_SESSION["patient_id"];

$stmt = $conn->prepare("SELECT prescription_id, drug_id, drug_dosage FROM prescriptions WHERE PATIENT_ID = ?");
$stmt->bind_param("i", $loggedInPatientID);
$stmt->execute();
$result = $stmt->get_result(); 
 if ($result->num_rows > 0) : ?>
    <table>
        <tr>
            <th>Prescription ID</th>
            <th>Drug ID</th>
            <th>Drug Dosage</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["prescription_id"]; ?></td>
                <td><?php echo $row["drug_id"]; ?></td>
                <td><?php echo $row["drug_dosage"]; ?></td>
            </tr>
        <?php endwhile; ?>

    </table>
<?php else : ?>
    <p>No prescriptions found for the patient.</p>
<?php endif; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>










