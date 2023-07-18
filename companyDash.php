
    <?php
    require("EasyDawa.php");

    $sql = "SELECT * FROM company_info";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Company ID</th><th>Company Name</th><th>Address</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Company_ID"] . "</td>";
            echo "<td>" . $row["Company_Name"] . "</td>";
            echo "<td>" . $row["Address"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }
    if ($stmt->fetch()) {
        
        header("Location: companyDash.html");
        exit;
    } else {
        // Invalid credentials, deny access
        echo "Invalid credentials. Please try again.";
    }
    

    $conn->close();
    ?>
</body>
</html>
