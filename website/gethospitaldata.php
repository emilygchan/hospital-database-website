<!-- php for showing the information of the chosen hospital and doctors who work at the chosen hospital -->

<?php
    // gets the value chosen for the hospital
    $whichHos = $_POST["pickahospital"];
    // query for getting the hospital information
    $query1 = 'SELECT hosname, city, prov, numofbed, firstname, lastname FROM hospital, doctor WHERE headdoc = licensenum AND hoscode = "' . $whichHos . '"';
    $result1 = mysqli_query($connection, $query1);
    
    // if the query did not work, prints a message and exits
    if (!$result1) {
         die("databases query failed. ");
    }

    // outputs the information of the chosen hospital in a table
    echo "<br><br>";
    echo "<b>Hospital Information: </b><br><br>";
    echo "<table>";   
    echo "<tr>";
    echo "<th>" . "Hospital Code" . "</th>";
    echo "<th>" . "Hospital Name" . "</th>";
    echo "<th>" . "City" . "</th>";
    echo "<th>" . "Province" . "</th>";
    echo "<th>" . "Number of Beds" . "</th>";
    echo "<th>" . "Head Doctor Name" . "</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result1)) {
        echo "<tr>";
        echo "<td>" . $whichHos . "</td>";
        echo "<td>" . $row["hosname"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "<td>" . $row["prov"] . "</td>";
        echo "<td>" . $row["numofbed"] . "</td>";
        echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
        echo "</tr>";
        echo "<table><br><br>";
        echo "<b>" . "All the doctors that work at " . $whichHos . " - " . $row["hosname"] . ":" . "</b>";
        echo "<br><br>";  
        
    }
    mysqli_free_result($result1);
    
    // query for getting all the doctor's license number, first name, and last name that work at the chosen hospital
    $query2 = 'SELECT licensenum, firstname, lastname FROM hospital, doctor WHERE hoscode = hosworksat AND hoscode = "' . $whichHos . '"';
    $result2 = mysqli_query($connection, $query2);
    
    // if the query did not work, prints a message and exits
    if (!$result2) {
         die("databases query failed. ");
    }

    // outputs all the doctors that work at the chosen hospital in a table
    echo "<table>";   
    echo "<tr>";
    echo "<th>" . "License Number" . "</th>";
    echo "<th>" . "Doctor Name" . "</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result2)) {
        echo "<tr>";
        echo "<td>" . $row["licensenum"] . "</td>";
        echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
        echo "</tr>";
    }
    echo "<table>";
    mysqli_free_result($result2);
?>
