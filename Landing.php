<html>

<body>

    Welcome <?php echo $_POST["name"]; ?><br>
    Your email address is: <?php echo $_POST["email"]; ?>

    <?php
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "drugdispensingtool";

    $fname = $_POST["F_Name"];
    $lname = $_POST["L_Name"];
    $dob = $_POST["DOB"];
    $idno = $_POST["ID_No"];
    $Phone = $_POST["Phone_No"];


    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO patients VALUES ('$fname', '$lname', '$dob','$idno','$Phone')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "SELECT F_Name, L_Name, DOB, ID_No, Phone_No";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo " - Name: " . $row["F_Name"] . " " . $row["L_Name"] . "<br> - Date Of Birth: " . $row["DOB"] .  "<br> - ID Number: " . $row["ID_No"] . "<br> - Phone Number: " . $row["Phone_No"]. "<br><br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

</body>

</html>