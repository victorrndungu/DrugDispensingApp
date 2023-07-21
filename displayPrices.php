<?php
require("EasyDawa.php");

// Assuming $conn is defined in EasyDawa.php, otherwise establish the connection here

// Fetch the drugs and their prices information from the database
$sql = "SELECT drug_info.drug_id, drug_name, drug_type, drug_form, drug_prices.drug_price 
        FROM drug_info 
        JOIN drug_prices ON drug_info.drug_id = drug_prices.drug_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Drug Prices</title>
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
    <h1>Drug Prices</h1>
    <?php if ($result->num_rows > 0) : ?>
        <table>
            <tr>
                <th>Drug ID</th>
                <th>Drug Name</th>
                <th>Drug Type</th>
                <th>Drug Form</th>
                <th>Price</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row["drug_id"]; ?></td>
                    <td><?php echo $row["drug_name"]; ?></td>
                    <td><?php echo $row["drug_type"]; ?></td>
                    <td><?php echo $row["drug_form"]; ?></td>
                    <td><?php echo $row["drug_price"]; ?></td>
                </tr>
            <?php endwhile; ?>

        </table>
    <?php else : ?>
        <p>No drug prices found.</p>
    <?php endif; ?>

    <p>&copy; <?php echo date("Y"); ?> EasyDawa. All rights reserved.</p>
</body>

</html>
