<!-- php for showing all the patients of the chosen doctor -->

<?php
    // gets the value chosen for the doctor
    $whichDoc = $_POST["pickadoctor"];
    // query for getting the first name and last name of the chosen doctor
    $query1 = 'SELECT firstname, lastname FROM doctor WHERE doctor.licensenum = "' . $whichDoc . '"';
    $result1 = mysqli_query($connection, $query1);
    
    // if the query did not work, prints a message and exits
    if (!$result1) {
         die("database query failed. ");
    }
    echo "<br><br>";
    
    // prints who the doctor is
    while ($row = mysqli_fetch_assoc($result1)) {
        echo "Patients of " . $row["firstname"] . " " . $row["lastname"] . ":";
    }
    mysqli_free_result($result1);

    // query for getting the patient's first name, last name, and OHIP number of the chosen doctor
    $query2 = 'SELECT patient.firstname as pfname, patient.lastname as plname, patient.ohipnum FROM doctor, patient, looksafter WHERE doctor.licensenum = looksafter.licensenum AND patient.ohipnum = looksafter.ohipnum AND doctor.licensenum = "' . $whichDoc . '"';
    $result2 = mysqli_query($connection, $query2);
    
    // if the query did not work, prints a message and exits
    if (!$result2) {
         die("database query failed. ");
    }

    // outputs all the patients of the chosen doctor in a table
    echo "<br><br>";
    echo "<table>";   
    echo "<tr>";
    echo "<th>" . "OHIP Number" . "</th>";
    echo "<th>" . "Patient Name" . "</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result2)) {
        echo "<tr>";
        echo "<td>" . $row["ohipnum"] . "</td>";
        echo "<td>" . $row["pfname"] . " " . $row["plname"] . "</td>";
        echo "</tr>";
    }
    echo "<table>";

    mysqli_free_result($result2);
?>
