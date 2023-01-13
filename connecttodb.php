<!-- php that connects to the database -->

<?php
    $dbhost = "localhost";
    $dbuser= "root";
    $dbpass = "1234";
    $dbname = "hospitaldb";
    $connection = mysqli_connect($dbhost, $dbuser,$dbpass, $dbname);
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }
?>
