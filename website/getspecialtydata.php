<!-- php for getting doctor information of the chosen specialty -->

<?php
    // gets the value chosen for the specialty
    $whichSpec = $_POST["pickaspecialty"];
    // query for getting the doctor information of the chosen specialty
    $query = 'SELECT * FROM doctor WHERE specialty = "' . $whichSpec . '"'; 
    $result = mysqli_query($connection, $query);
    
    // if the query did not work, prints a message and exits
    if (!$result) {
        die("database query failed.");
    }
    
    // outputs the doctor information based on the chosen specialty in a table
    echo "<br>";
    echo "<b>";
    echo $whichSpec . "s: ";
    echo "</b>";
    echo "<br><br>";
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
        echo "<td>" . $row["firstname"] . " " . $row["lastname"] . " </td>";
        echo "<td>" . $row["licensedate"] . "</td>";
        echo "<td>" . $row["birthdate"] . "</td>";
        echo "<td>" . $row["hosworksat"] . "</td>";
        echo "<td>" . $row["specialty"] . "</td>";
        echo "</tr>";
    }
    echo "<table><br>";

    mysqli_free_result($result);
?>
