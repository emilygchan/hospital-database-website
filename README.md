# hospital-database-website
Database website that uses CSS, HTML, PHP, and MySQL. The database keeps track of information for doctors, patients, hospitals, and the patients the doctors look after.

The website leverages SQL statements, such as SELECT, INSERT, and DELETE, to do the following:
* Order doctor information
* Get doctor information based on the specialty
* Add a new doctor
* Delete an existing doctor
* Assign a doctor to a patient
* Get all the patients for a chosen doctor
* Get information of a chosen hospital and doctors who work at the chosen hospital
* Update the number of beds at a hospital

## Run project
* Edit website/connecttodb.php with your database details
  * $dbhost = "localhost";
  * $dbuser = "username";
  * $dbpass = "password";
  * $dbname = "hospitaldb";
* Download website/ and place in your apache server
* Download hosp.sql and run the file in MySQL command line
  * mysql> source /path/to/hosp.sql
* Browse to http://hostname/home.php
