<?php
require("EasyDawa.php");
session_start();

$patientID = $_SESSION["patient_id"];


$loggedInPatientID =   $_SESSION["patient_id"];

$stmt = $conn->prepare("SELECT prescription_id, drug_id, drug_dosage FROM prescriptions WHERE PATIENT_ID = ?");
$stmt->bind_param("i", $loggedInPatientID);
$stmt->execute();
$result = $stmt->get_result();

// Display the prescriptions
if ($result->num_rows > 0) {
    echo "<h1>Patient Prescriptions</h1>";
    echo "<table>";
    echo "<tr><th>Prescription ID</th><th>Drug ID</th><th>Drug Dosage</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["prescription_id"] . "</td>";
        echo "<td>" . $row["drug_id"] . "</td>";
        echo "<td>" . $row["drug_dosage"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No prescriptions found for the patient.</p>";
}

$stmt->close();
$conn->close();
?>
