<!-- php for getting all the doctors -->

<?php
    $query = "SELECT * FROM doctor";
    $result = mysqli_query($connection, $query);
    
    // if the query did not work, prints a message and exits
    if (!$result) {
        die("database query failed.");
    }

    // outputs all doctors as options and as radio buttons
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<input type="radio" name="doctor" value="';
        echo $row["licensenum"];
        echo '">' . $row["firstname"] . " " . $row["lastname"] . "<br>";
    }
    mysqli_free_result($result);
?>

