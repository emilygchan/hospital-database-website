<!-- webpage that updates the number of beds of the chosen hospital -->

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Database - Number of Beds Updated</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php
    // php for updating the number of beds for a hospital
    mysqli_report(MYSQLI_REPORT_OFF);
    include 'connecttodb.php';
    // gets the value chosen for the hospital and the new number of beds
    $hospital = $_POST["pickahospital"];
    $numbeds = $_POST["numbeds"];
    
    // query to update the number of beds at the hospital
    $query = 'UPDATE hospital SET numofbed = "' . $numbeds . '" WHERE hoscode = "' . $hospital . '"';
    
    // if the query did not work, prints a message and exits
    if (!mysqli_query($connection, $query)) {
        die("Error: update failed. " . mysqli_error($connection));
    }
    
    // if the query worked, lets the user know the number of beds was updated for the chosen hospital
    echo "<h3>" . "The number of beds was updated!" . "</h3><br>";
    
    // php for displaying the hospital information with the new number of beds
    $query = "SELECT hoscode, hosname, numofbed FROM hospital";
    $result=mysqli_query($connection,$query);
    // if the query did not work, prints a message and exits
    if (!$result) {
         die("database query failed.");
    }
    
    // outputs all the hospitals with their hospital code, hospital name, and number of beds with the updated number of beds for the chosen hospital in a table
    echo "All hospitals:<br><br>";
    echo "<table>";   
    echo "<tr>";
    echo "<th>" . "Hospital Code" . "</th>";
    echo "<th>" . "Hospital Name" . "</th>";
    echo "<th>" . "Number of Beds" . "</th>";
    echo "</tr>";
    while ($row=mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["hoscode"]  . "</td>";
        echo "<td>" . $row["hosname"] . "</td>";
        echo "<td>" . $row["numofbed"] . "</td>";
        echo "</tr>";
    }
    echo "<table><br>";
    
    mysqli_free_result($result);
    mysqli_close($connection);
?>
<br>
    
<!-- button to go home -->
<form action="home.php" method="post" id="home">
<input type="submit" value="Go Home">
</form>
</body>
</html>


