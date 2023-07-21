<?php
require("EasyDawa.php");
session_start();


// Check if the doctor is logged in
if (!isset($_SESSION["DOCTORS_ID"])) {
    header("Location: doctorLogin.html");
    exit;
}

// Fetch the drugs information from the database
$drugQuery = "SELECT drug_id, drug_name, drug_type, drug_form FROM drug_info";
$drugResult = $conn->query($drugQuery);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    if (isset($_POST["prescription_id"]) && isset($_POST["drug_id"]) && isset($_POST["drug_dosage"]) && isset($_POST["PATIENT_ID"]) && isset($_POST["DOCTORS_ID"])) {
        $prescription_id = $_POST["prescription_id"];
        $drug_id = $_POST["drug_id"];
        $drug_dosage = $_POST["drug_dosage"];
        $patient_id = $_POST["PATIENT_ID"];
        $doctor_id = $_POST["DOCTORS_ID"];

        // Prepare and execute the SQL query to insert prescription into the database
        $sql = "INSERT INTO prescriptions (prescription_id, drug_id, drug_dosage, PATIENT_ID, DOCTORS_ID)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissi", $prescription_id, $drug_id, $drug_dosage, $patient_id, $doctor_id);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            echo "Prescription added successfully!";
        } else {
            echo "Error adding prescription. Please try again.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Incomplete form data. Please fill in all the required fields.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Prescription</title>
    <link rel="stylesheet" href="insertPrescription.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Helvetica">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="LandingAssets/White Icon.png">
</head>

<body>
    <div class="form">
    <div class="home">
            <a href="homepage.html"><img src="LandingAssets/Black Logo.png" alt=""></a>
        </div>
        <br>
        <hr>
        <h1>Add Prescription</h1>
        <hr>
        <form method="post" action="viewPatient.php">
            <div class="content">
                <div class="labels">
                    <label for="prescription_id">Prescription ID:</label>
                    <label for="drug_id">Drug ID:</label>
                    <label for="drug_dosage">Drug Dosage:</label>
                    <label for="PATIENT_ID">Patient ID:</label>
                    <label for="DOCTORS_ID">Doctor ID:</label>
                </div>
                <div class="inputs">
                    <input type="number" name="prescription_id" required><br>
    
                    <select name="drug_id" required>
                        <option value="">Select Drug</option>
                        <?php
                        if ($drugResult->num_rows > 0) {
                            while ($row = $drugResult->fetch_assoc()) {
                                $optionValue = $row['drug_id'];
                                $optionLabel = $row['drug_id'] . ' - ' . $row['drug_name'] . ' (' . $row['drug_type'] . ', ' . $row['drug_form'] . ')';
                                echo "<option value='$optionValue'>$optionLabel</option>";
                            }
                        }
                        ?>
                    </select><br>
    
                    
                    <input type="text" name="drug_dosage" required><br>
    
                    
                    <input type="number" name="PATIENT_ID" required><br>
    
                    <input type="number" name="DOCTORS_ID" required><br>
                </div>
            </div>
            <input type="submit" value="Add Prescription">
        </form>
    </div>
</body>

</html>
