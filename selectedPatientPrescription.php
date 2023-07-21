<?php
require("EasyDawa.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["PATIENT_ID"])) {
        $patient_id = $_POST["PATIENT_ID"];

        // Fetch the patient details from the database
        $sql = "SELECT * FROM patients_info WHERE PATIENT_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $patient = $result->fetch_assoc();
        } else {
            echo "Patient not found.";
            exit;
        }

        // Fetch the prescription details for the selected patient
        $sql = "SELECT * FROM prescriptions WHERE PATIENT_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Close the statement
        $stmt->close();

    } else {
        echo "Invalid request. Please provide a valid PATIENT_ID.";
        exit;
    }
} else {
    echo "Invalid request method. Only POST requests are allowed.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Selected Patient Prescription</title>
</head>
<body>
    <h1>Selected Patient Prescription</h1>
    <?php if ($patient) : ?>
        <h2>Patient Information</h2>
        <p>Patient ID: <?php echo $patient["PATIENT_ID"]; ?></p>
        <p>First Name: <?php echo $patient["FIRST_NAME"]; ?></p>
        <p>Last Name: <?php echo $patient["LAST_NAME"]; ?></p>
        <p>Gender: <?php echo $patient["GENDER"]; ?></p>
        <p>Age: <?php echo $patient["AGE"]; ?></p>
        <p>Email Address: <?php echo $patient["EMAIL_ADDRESS"]; ?></p>

        <?php if ($result->num_rows > 0) : ?>
            <h2>Prescription Information</h2>
            <table border="1">
                <tr>
                    <th>Prescription ID</th>
                    <th>Drug ID</th>
                    <th>Drug Dosage</th>
                    <th>Doctor ID</th>
                    <th>Dispense</th>
                </tr>

                <?php while ($prescription = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $prescription["prescription_id"]; ?></td>
                        <td><?php echo $prescription["drug_id"]; ?></td>
                        <td><?php echo $prescription["drug_dosage"]; ?></td>
                        <td><?php echo $prescription["DOCTORS_ID"]; ?></td>
                        <td>
                            <form method="post" action="dispensePrescription.php">
                                <input type="hidden" name="prescription_id" value="<?php echo $prescription["prescription_id"]; ?>">
                                <input type="hidden" name="drug_id" value="<?php echo $prescription["drug_id"]; ?>">
                                <input type="hidden" name="dispense_date" value="<?php echo date('Y-m-d'); ?>">
                                <!-- Include the PATIENT_ID from the selected patient prescription -->
                                <input type="hidden" name="PATIENT_ID" value="<?php echo $_POST["PATIENT_ID"]; ?>">
                                <!-- Include the DOCTORS_ID from the selected patient prescription -->
                                <input type="hidden" name="DOCTORS_ID" value="<?php echo $prescription["DOCTORS_ID"]; ?>">
                                <input type="submit" value="Dispense">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>

            </table>
        <?php else : ?>
            <p>No prescription found for this patient.</p>
        <?php endif; ?>

    <?php else : ?>
        <p>Patient not found.</p>
    <?php endif; ?>

    <a href="pharmacyDash.html">Back to Pharmacy Dashboard</a>
</body>

</html>
