<!-- webpage for deleting the doctor -->

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Database - Doctor Deleted</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php
    // php for deleting the existing doctor
    mysqli_report(MYSQLI_REPORT_OFF);
    include 'connecttodb.php';
    // gets the value chosen for the doctor to be deleted
    $licensenum = $_POST["licensenum"];
    
    // query to delete the doctor from the table
    $query = 'DELETE FROM doctor WHERE licensenum = "' . $licensenum . '"';
    
    // if the query did not work, prints a message and exits
    if (!mysqli_query($connection, $query)) {
        die("Error: delete failed. " . mysqli_error($connection));
    }
    
    // if the query worked, lets the user know the doctor was deleted
    echo "<h3>" . "Your doctor was deleted!" . "</h3>";
    echo "<br>";
    
    // php for showing all doctor information with the existing doctor deleted
    $query = 'SELECT * FROM doctor';
    $result = mysqli_query($connection, $query);
    // if the query did not work, prints a message and exits
    if (!$result) {
        die("database query failed. ");
    }
    
    // outputs all the doctor information with the chosen doctor deleted in a table
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
