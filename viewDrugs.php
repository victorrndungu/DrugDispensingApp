<?php
require("EasyDawa.php");
session_start();

// Assuming $conn is defined in EasyDawa.php, otherwise establish the connection here

// Check if the doctor is logged in
if (!isset($_SESSION["DOCTORS_ID"])) {
    header("Location: doctorLogin.html");
    exit;
}

// Fetch the drugs information from the database
$sql = "SELECT drug_id, drug_name, drug_type, drug_form FROM drug_info";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Select Drug</title>
    <link rel="stylesheet" href="viewdrugs.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Helvetica">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="LandingAssets/White Icon.png">
</head>

<body>
    <h1>Select Drug</h1>
    <hr>
        <form method="post" action="insertPrescription.php">
            <div class="table">

                <table border="2">
                    <tr>
                        <th>Select</th>
                        <th>Drug ID</th>
                        <th>Drug Name</th>
                        <th>Drug Type</th>
                        <th>Drug Form</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td>
                                <input type="radio" name="drug_id" value="<?php echo $row["drug_id"]; ?>" required>
                            </td>
                            <td><?php echo $row["drug_id"]; ?></td>
                            <td><?php echo $row["drug_name"]; ?></td>
                            <td><?php echo $row["drug_type"]; ?></td>
                            <td><?php echo $row["drug_form"]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <br>
            <center><input type="submit" value="Select Drug"></center>
        </form>
    <p>&copy; 2023 EasyDawa. All rights reserved.</p>
</body>

</html>

