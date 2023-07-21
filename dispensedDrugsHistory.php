<?php
require("EasyDawa.php");

// Fetch the dispensed drugs history from the database
$sql = "SELECT ddh.dispense_id, ddh.prescription_id, ddh.drug_id, pat.FIRST_NAME, pat.LAST_NAME, ddh.dispense_date
        FROM dispersed_drugs_history ddh
        INNER JOIN prescriptions p ON ddh.prescription_id = p.prescription_id
        INNER JOIN patients_info pat ON p.PATIENT_ID = pat.PATIENT_ID";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dispensed Drugs History</title>
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
    <h1>Dispensed Drugs History</h1>
    <?php if ($result->num_rows > 0) : ?>
        <table>
            <tr>
                <th>Dispense ID</th>
                <th>Prescription ID</th>
                <th>Patient Name</th>
                <th>Drug ID</th>
                <th>Dispense Date</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row["dispense_id"]; ?></td>
                    <td><?php echo $row["prescription_id"]; ?></td>
                    <td><?php echo $row["FIRST_NAME"] . ' ' . $row["LAST_NAME"]; ?></td>
                    <td><?php echo $row["drug_id"]; ?></td>
                    <td><?php echo $row["dispense_date"]; ?></td>
                </tr>
            <?php endwhile; ?>

        </table>
    <?php else : ?>
        <p>No dispensed drugs history found.</p>
    <?php endif; ?>

</body>

</html>
