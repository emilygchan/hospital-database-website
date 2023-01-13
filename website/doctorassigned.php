<!-- webpage for assigning the doctor to a patient -->

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Database - Doctor Assigned</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php
    // php for assigning the doctor to a patient
    mysqli_report(MYSQLI_REPORT_OFF);
    include 'connecttodb.php';
    
    // gets the values chosen for the doctor and patient
    $doctor = $_POST["doctor"];
    $patient = $_POST["patient"];
    
    // query for assigning the chosen doctor to the chosen patient
    $query = 'INSERT INTO looksafter values("' . $doctor . '","' . $patient . '")';
    
    // if the query did not work, prints a message and exits
    if (!mysqli_query($connection, $query)) {
        die("Error: patient already assigned to this doctor.");
    }

    // if the query worked, lets the user know the doctor was assigned to the patient
    echo "<h3>" . "Patient assigned to doctor!" . "</h3>";
    echo "<br>";
    
    // php for showing all looksafter information with the doctor assigned to patient
    $query = "SELECT doctor.firstname as docfname, doctor.lastname as doclname, patient.firstname as pfname, patient.lastname as plname FROM doctor, patient, looksafter WHERE doctor.licensenum = looksafter.licensenum AND patient.ohipnum = looksafter.ohipnum ORDER BY docfname";
    $result=mysqli_query($connection, $query);
    // if the query did not work, prints a message and exits
    if (!$result) {
        die("database query failed.");
    }
    
    // outputs all the looksafter information with the chosen doctor assigned to the chosen patient in a table
    echo "All doctors and patients they are assigned to:<br><br>";
    echo "<table>";   
    echo "<tr>";
    echo "<th>" . "Doctor Name" . "</th>";
    echo "<th>" . "Patient Name" . "</th>";
    echo "</tr>";
    while ($row=mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["docfname"] . " " . $row["doclname"] . "</td>";
        echo "<td>" . $row["pfname"] . " " . $row["plname"] . "</td>";
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

