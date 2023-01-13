<!-- homepage -->

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Database</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    
    <script>
        // JavaScript function for confirming the deletion of a doctor
        function confirmdelete() {
            if (confirm("Are you sure you want to delete this doctor?") == false) {
                event.preventDefault();
            }
        }
    </script>
    
</head>
<body>
    
<?php
    include "connecttodb.php";
?>

<h1>Welcome to the Hospital Database Website!</h1>

<hr id="orderdocs">

<!-- section for ordering doctor information -->
<h2>Order Doctor Information</h2>
<form action="" method="post">
<!-- radio buttons for ordering -->
<b>Order by last name or by birthdate:</b><br>
<input type="radio" name="orderby" value="lastname">Last Name<br>
<input type="radio" name="orderby" value="birthdate">Birthdate<br><br>
<b>Order in ascending or descending:</b><br>
<input type="radio" name="orderin" value="asc">Ascending<br>
<input type="radio" name="orderin" value="desc">Descending<br><br>
<!-- submit button to order the doctor information -->
<input type="submit" value="Order Doctor Information" onclick="location.href='#orderdocs'">
</form>
<br><br>
<!-- php for ordering doctor information  -->
<?php
    if (isset($_POST['orderby']) && isset($_POST['orderin'])) {
        include 'orderdoctordata.php';    
    }
?>

<div class="line" id="spec"></div>

<!-- section for getting doctor information based on a chosen specialty -->
<h2>Get Doctor Information Based on the Specialty</h2>
<h3>Select a specialty:</h3>
<form action="" method="post">
<!-- select button -->
<select name="pickaspecialty">
    <option value="">--- Select Here ---</option>
        <?php
            // php for getting all specialties for dropdown menu
            $query = "SELECT DISTINCT specialty FROM doctor";
            $result = mysqli_query($connection,$query);
            // if the query did not work, prints a message and exits
            if (!$result) {
                die("database query failed.");
            }
            // outputs all specialties as an option for the dropdown menu
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row["specialty"] . "'>";
                echo $row["specialty"];
                echo '</option>';
            }
            mysqli_free_result($result);
        ?>
</select>
<!-- submit button to get all the doctor information based on the specialty -->
<input type="submit" name="Submit" onclick="location.href='#spec'">
</form>
<br>
<!-- php for getting doctor information of the chosen specialty -->
<?php
    if (isset($_POST['pickaspecialty']) && $_POST['pickaspecialty'] != "") { 
        include "getspecialtydata.php";
    }
?>
<br>
    
<div class="line"></div>

<!-- section for adding a new doctor -->
<h2>Add a New Doctor</h2>
<form action="doctoradded.php" method="post">
<!-- input text boxes for license number, first name, and last name -->
New Doctor's License Number: <input type="text" name="licensenum"><br><br>
New Doctor's First Name: <input type="text" name="firstname"><br><br>
New Doctor's Last Name: <input type="text" name="lastname"><br><br>
<!-- input box for dates for license date and birth date -->
New Doctor's License Date: <input type="date" name="licensedate"><br><br>
New Doctor's Birth Date: <input type="date" name="birthdate"><br><br>
<!-- radio buttons for the options of hospitals a doctor can work at -->
New Doctor's Hospital They Work At:
<br>
<?php
    // php for getting all the hospitals a doctor can work at
    $query = "SELECT * FROM hospital";
    $result = mysqli_query($connection,$query);
    // if the query did not work, prints a message and exits
    if (!$result) {
        die("database query failed.");
    }
    // outputs all hospitals a doctor can work at as options
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<input type="radio" name="hosworksat" value="';
        echo $row["hoscode"];
        echo '">' . $row["hoscode"] . " - " . $row["hosname"] . "<br>";
    }
    mysqli_free_result($result);
?>
<br>
<!-- input text box for specialty -->
New Doctor's Specialty: <input type="text" name="specialty"><br><br>
<!-- submit button to add a new doctor with the given information -->
<input type="submit" value="Add New Doctor">
</form>
<br><br>

<div class="line"></div>

<!-- section for deleting a doctor -->
<h2>Delete an Existing Doctor</h2>
<h3>Choose which doctor to delete:</h3>
<form action="doctordeleted.php" method="post">
<!-- radio buttons for the options of doctors -->
<?php
    // php for getting all licensenums for doctor options
    $query = "SELECT * FROM doctor";
    $result = mysqli_query($connection,$query);
    // if the query did not work, prints a message and exits
    if (!$result) {
        die("database query failed.");
    }
    // outputs all doctors as options
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<input type="radio" name="licensenum" value="';
        echo $row["licensenum"];
        echo '">' . $row["licensenum"] . " -  " . $row["firstname"] . " " . $row["lastname"] . "<br>";
    }
    mysqli_free_result($result);
?>
<br>
<!-- submit button to delete the chosen doctor -->
<input type="submit" value="Delete Doctor" onclick="return confirmdelete()"> 
</form>
<br><br> 

<div class="line"></div>

<!-- section for assigning a doctor to a patient -->
<h2>Assign a Doctor to a Patient</h2>
<form action="doctorassigned.php" method="post">
<h3>Choose a doctor:</h3>
<!-- php for getting all the doctors -->
<?php
    include "getdocs.php";
?>
<br>
<h3>Choose a patient:</h3>
<!-- php for getting all the patients -->
<?php
    include "getpatients.php";
?>
<br><br>
<!-- submit button to assign the chosen doctor to the chosen patient -->
<input type="submit" value="Assign Doctor to Patient">
</form>
<br><br>

<div class="line" id="patients"></div>

<!-- section for getting all the patient of a chosen doctor -->
<h2>Get All the Patients For a Chosen Doctor</h2>
<h3>Select a doctor:</h3>
<form action="" method="post">
<!-- select button -->
<select name="pickadoctor">
    <option value="">--- Select Here ---</option>
        <?php
            // php for getting all the doctors for the dropdown menu
            $query = "SELECT *  FROM doctor";
            $result = mysqli_query($connection,$query);
            // if the query did not work, prints a message and exits
            if (!$result) {
                die("database query failed.");
            }
            // outputs all doctors as an option for the dropdown menu
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row["licensenum"] . "'>";
                echo $row["licensenum"] . " - " . $row["firstname"] . " " . $row["lastname"];
                echo '</option>';
            }
            mysqli_free_result($result);
        ?>
</select>
<!-- submit button to get all the patients of the chosen doctor -->
<input type="submit" name="Submit" onclick="location.href='#patients'">
</form>
<!-- php for getting all the patients of the chosen doctor -->
<?php
    if (isset($_POST['pickadoctor']) && $_POST['pickadoctor'] != "") { 
        include "getdoctortreatdata.php";
    }
?>
<br><br>

<div class="line" id="hosp"></div>

<!-- section for getting information of a chosen hospital and the doctors that work at the chosen hospital -->
<h2>Get Information of a Chosen Hospital and Doctors Who Work at The Chosen Hospital</h2>
<h3>Select a hospital:</h3>
<form action="" method="post">
<!-- select button -->
<select name="pickahospital">
    <option value="">--- Select Here ---</option>
        <?php
            // php for getting all the hospitals for the dropdown menu
            $query = "SELECT * FROM hospital";
            $result = mysqli_query($connection,$query);
            // if the query did not work, prints a message and exits
            if (!$result) {
                die("database query failed.");
            }
            // outputs all hospitals as an option for the dropdown menu
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row["hoscode"] . "'>";
                echo $row["hoscode"] . " - " . $row["hosname"];
                echo '</option>';
            }
            mysqli_free_result($result);
        ?>
</select>
<!-- submit button to get the information of the chosen hospital and the doctors that work at the chosen hospital -->
<input type="submit" name="Submit" onclick="location.href='#hosp'">
</form>
<!-- php for getting the information of the chosen hospital and all the doctors that work at the chosen hospital  -->
<?php
    if (isset($_POST['pickahospital']) && $_POST['pickahospital'] != "") {
        include "gethospitaldata.php";
    }
?>
<br><br>

<div class="line"></div>

<!-- section for updating the number of beds at a hospital -->
<h2>Update the Number of Beds at a Hospital</h2>
<form action="numbedsupdated.php" method="post">
<!-- select button -->
Select a hospital: <select name="pickahospital">
    <option value="">--- Select Here ---</option>
        <?php
            // php for getting all the hospitals for the dropdown menu
            $query = "SELECT * FROM hospital";
            $result = mysqli_query($connection,$query);
            // if the query did not work, prints a message and exits
            if (!$result) {
                die("database query failed.");
            }
            // outputs all hospitals as an option for the dropdown menu
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row["hoscode"] . "'>";
                echo $row["hoscode"] . " - " . $row["hosname"];
                echo '</option>';
            }
            mysqli_free_result($result);
        ?>
</select>
<br><br>
<!-- input box for number of beds -->
New Number of Beds: <input type="number" name="numbeds"><br><br>
<!-- submit button to update the number of beds at the chosen hospital -->
<input type="submit" value="Update Number of Beds">
</form>
<br><br>

<?php
    mysqli_close($connection);
?>
    
</body>
</html>