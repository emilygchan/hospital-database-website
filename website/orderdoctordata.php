<!-- php for ordering doctor information -->

<?php
    // gets the values chosen for ordering by and ordering in
    $orderBy = $_POST["orderby"];
    $orderIn = $_POST["orderin"];
    // query for getting all the doctor information in the chosen order
    $query = "SELECT * FROM doctor ORDER BY $orderBy $orderIn";
    $result = mysqli_query($connection, $query);
    
    // if the query did not work, prints a message and exits
    if (!$result) {
        die("database query failed.");
    }

    // outputs the doctor information in the chosen order in a table
    echo "<b>" . "Ordered by: " . $orderBy . ", " . $orderIn . "ending" . "</b><br><br>";
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
?>

