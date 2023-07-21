<?php
require("EasyDawa.php");

// Check if the patient is logged in
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["patient_id"])) {
    header("Location: patientLogin.html");
    exit;
}

// Retrieve patient_id from the session
$patient_id = $_SESSION["patient_id"];

// Fetch drugs dispensed for the current patient and their prices
$sql = "SELECT ddh.dispense_id, ddh.prescription_id, ddh.drug_id, dp.drug_price, ddh.dispense_date
        FROM dispersed_drugs_history ddh
        INNER JOIN drug_prices dp ON ddh.drug_id = dp.drug_id
        WHERE ddh.patient_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Dispensed Drugs</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>View Dispensed Drugs</h1>
    <?php if ($result->num_rows > 0) : ?>
        <table>
            <tr>
                <th>Dispense ID</th>
                <th>Prescription ID</th>
                <th>Drug ID</th>
                <th>Price</th>
                <th>Dispense Date</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row["dispense_id"]; ?></td>
                    <td><?php echo $row["prescription_id"]; ?></td>
                    <td><?php echo $row["drug_id"]; ?></td>
                    <td><?php echo $row["drug_price"]; ?></td>
                    <td><?php echo $row["dispense_date"]; ?></td>
                </tr>
            <?php endwhile; ?>

        </table>
    <?php else : ?>
        <p>No drugs dispensed for this patient.</p>
    <?php endif; ?>

</body>
</html>
