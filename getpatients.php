<!-- php for getting all the patients -->

<?php
    $query = "SELECT * FROM patient";
    $result = mysqli_query($connection, $query);
    
    // if the query did not work, prints a message and exits
    if (!$result) {
        die("database query failed.");
    }

    // outputs all patients as options and as radio buttons
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<input type="radio" name="patient" value="';
        echo $row["ohipnum"];
        echo '">' . $row["firstname"] . " " . $row["lastname"] . "<br>";
    }
    mysqli_free_result($result);
?>
