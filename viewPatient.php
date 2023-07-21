<?php
require("EasyDawa.php");
session_start();


if (!isset($_SESSION["DOCTORS_ID"])) {
   
    header("Location: doctorLogin.html");
    exit;
}

// Get the logged-in doctor's ID
$loggedInDoctorID = $_SESSION["DOCTORS_ID"];

// Fetch the patient information who have selected the logged-in doctor
$sql = "SELECT p.PATIENT_ID, p.FIRST_NAME, p.LAST_NAME, p.EMAIL_ADDRESS
        FROM patients_info p
        INNER JOIN selected_doctor sd ON p.PATIENT_ID = sd.PATIENT_ID
        WHERE sd.DOCTORS_ID = $loggedInDoctorID";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Patients</title>
    <link rel="stylesheet" href="viewPatients.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Helvetica">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <a href=""><img src="LandingAssets/Black Logo.png" alt=""></a>
        </div>
        <div class="nav">
            <ul>
                <li><a href="Landingdata.php">Home</a></li>
                <li><a href="doctorDash.html">Back</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="container">
        <h1>Patients who have selected you</h1>
        <hr>
        <?php if ($result->num_rows > 0) : ?>
            <div class="table">

                <table border="2">
                    <tr>
                        <th>PATIENT_ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                    </tr>
    
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row["PATIENT_ID"]; ?></td>
                            <td><?php echo $row["FIRST_NAME"]; ?></td>
                            <td><?php echo $row["LAST_NAME"]; ?></td>
                            <td><?php echo $row["EMAIL_ADDRESS"]; ?></td>
                            <td>
                                <form method="post" action="viewDrugs.php">
                                    <input type="hidden" name="PATIENT_ID" value="<?php echo $row["PATIENT_ID"]; ?>">
                                    <input type="submit" value="Make Prescription">
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
    
                </table>
            </div>

        <?php else : ?>
            <p>No patients found.</p>
        <?php endif; ?>
    </div>
    <p>&copy; 2023 EasyDawa. All rights reserved.</p>
</body>
</html>
