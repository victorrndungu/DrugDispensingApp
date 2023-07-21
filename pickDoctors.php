<?php
require("EasyDawa.php");

// Check if the session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the patient is logged in
if (!isset($_SESSION["patient_id"])) {
    // Redirect to the login page
    header("Location: patientLogin.html");
    exit;
}

// Fetch the doctor information from the database
$sql = "SELECT DOCTORS_ID, FIRST_NAME, LAST_NAME, SPECIALITY, YRS_OF_EXPERIENCE, EMAIL_ADDRESS FROM doctors_info";
$result = $conn->query($sql);

$doctorTable = "";
if ($result->num_rows > 0) {
    $doctorTable .= "<form method='post' action='selectDoctors.php'>";
    $doctorTable .= "<table border='1'>";
    $doctorTable .= "<tr>
                        <th>Select</th>
                        <th>DOCTORS_ID</th>
                        <th>FIRST_NAME</th>
                        <th>LAST_NAME</th>
                        <th>SPECIALITY</th>
                        <th>YRS_OF_EXPERIENCE</th>
                        <th>EMAIL_ADDRESS</th>
                    </tr>";

    while ($row = $result->fetch_assoc()) {
        $doctorTable .= "<tr>
                            <td>
                                <input type='checkbox' name='selectedDoctors[]' value='" . $row["DOCTORS_ID"] . "'>
                            </td>
                            <td>" . $row["DOCTORS_ID"] . "</td>
                            <td>" . $row["FIRST_NAME"] . "</td>
                            <td>" . $row["LAST_NAME"] . "</td>
                            <td>" . $row["SPECIALITY"] . "</td>
                            <td>" . $row["YRS_OF_EXPERIENCE"] . "</td>
                            <td>" . $row["EMAIL_ADDRESS"] . "</td>
                        </tr>";
    }

    $doctorTable .= "</table>";
    $doctorTable .= "<input type='submit' value='Select'>";
    $doctorTable .= "</form>";
} else {
    $doctorTable = "No doctors found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pick Patient</title>
    <link rel="stylesheet" href="viewPatients.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Helvetica">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="LandingAssets/White Icon.png">
</head>

<body>
    <div class="container">
        <h1>Select Doctors</h1>

        <div class="doctors-table">
            <?php echo $doctorTable; ?>
        </div>

    </div>
</body>

</html>

