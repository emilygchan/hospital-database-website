<!-- webpage for adding the new doctor -->

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Database - New Doctor Added</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>    
<?php
    // php for inserting the new doctor
    mysqli_report(MYSQLI_REPORT_OFF);
    include 'connecttodb.php';
    
    // gets the values chosen for all the fields of a doctor
    $licensenum = $_POST["licensenum"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $licensedate = $_POST["licensedate"];
    $birthdate = $_POST["birthdate"];
    $hosworksat = $_POST["hosworksat"];
    $specialty = $_POST["specialty"];   
    
    // query for adding a doctor with the given information
    $query = 'INSERT INTO doctor values("' . $licensenum . '","' . $firstname . '","' . $lastname . '","' . $licensedate . '","' . $birthdate . '","' . $hosworksat . '","' . $specialty . '")';
    
    // if the query did not work, prints a message and exits
    if (!mysqli_query($connection, $query)) {
        die("Error: insert failed. " . mysqli_error($connection));
    }
    
    // if the query worked, lets the user know the doctor was added
    echo "<h3>" . "Your doctor was added!" . "</h3>";
    echo "<br>";
    
    // php for showing all doctor information with the new doctor added
    $query = 'SELECT * FROM doctor';
    $result = mysqli_query($connection, $query);
    // if the query did not work, prints a message and exits
    if (!$result) {
        die("database query failed.");
    }
    
    // outputs all the doctor information with the new doctor added in a table
    echo "All doctors:<br><br>";
    echo "<table>";   
    echo "<tr>";
    echo "<th>" . "License Number" . "</th>";
    echo "<th>" . "Name" . "</th>";
    echo "<th>" . "License Date" . "</th>";
    echo "<th>" . "Birthdate" . "</th>";
    echo "<th>" . "Hospital Code" . "</th>";
    echo "<th>" . "Specialty" . "</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["licensenum"] . "</td>";
        echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
        echo "<td>" . $row["licensedate"] . "</td>";
        echo "<td>" . $row["birthdate"] . "</td>";
        echo "<td>" . $row["hosworksat"] . "</td>";
        echo "<td>" . $row["specialty"] . "</td>";
        echo "</tr>";
    }
    echo "<table><br><br>";

    mysqli_free_result($result);
    mysqli_close($connection);
?>

<!-- button to go home -->
<form action="home.php" method="post" id="home">
<input type="submit" value="Go Home">
</form>
</body>
</html>
