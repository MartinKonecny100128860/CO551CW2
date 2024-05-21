<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // If the form has been submitted
   if (isset($_POST['submit'])) {

      // Build an SQL statement to update the student details
      $sql = "UPDATE student SET 
              firstname = '" . $_POST['txtfirstname'] . "',
              lastname = '" . $_POST['txtlastname'] . "',
              house = '" . $_POST['txthouse'] . "',
              town = '" . $_POST['txttown'] . "',
              county = '" . $_POST['txtcounty'] . "',
              country = '" . $_POST['txtcountry'] . "',
              postcode = '" . $_POST['txtpostcode'] . "' 
              WHERE studentid = '" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn, $sql);

      $data['content'] = "<div class='message-container'><h1>Your details have been updated</h1></div>";

   } else {
      // Build an SQL statement to return the student record with the id that matches that of the session variable
      $sql = "SELECT * FROM student WHERE studentid='" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);

      // Using <<<EOD notation to allow building of a multi-line string
      $data['content'] = <<<EOD

            <div class="main-content">
            <h2>Edit Details</h2>
            <form name="frmdetails" action="" method="post">
               <div class="form-row">
                  <label for="txtfirstname"><i class="fas fa-user"></i> First Name:</label>
                  <input name="txtfirstname" type="text" value="{$row['firstname']}" />
               </div>
               <div class="form-row">
                  <label for="txtlastname"><i class="fas fa-user"></i> Surname:</label>
                  <input name="txtlastname" type="text" value="{$row['lastname']}" />
               </div>
               <div class="form-row">
                  <label for="txthouse"><i class="fas fa-home"></i> Address:</label>
                  <input name="txthouse" type="text" value="{$row['house']}" />
               </div>
               <div class="form-row">
                  <label for="txttown"><i class="fas fa-map-marker-alt"></i> Town:</label>
                  <input name="txttown" type="text" value="{$row['town']}" />
               </div>
               <div class="form-row">
                  <label for="txtcounty"><i class="fas fa-map-marker-alt"></i> County:</label>
                  <input name="txtcounty" type="text" value="{$row['county']}" />
               </div>
               <div class="form-row">
                  <label for="txtcountry"><i class="fas fa-globe"></i> Country:</label>
                  <input name="txtcountry" type="text" value="{$row['country']}" />
               </div>
               <div class="form-row">
                  <label for="txtpostcode"><i class="fas fa-envelope"></i> Postcode:</label>
                  <input name="txtpostcode" type="text" value="{$row['postcode']}" />
               </div>
               <div class="submit-btn">
                  <input type="submit" value="Save" name="submit"/>
               </div>
            </form>
         </div>
      
   EOD;
   }

   // Render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>

<style>
/* Existing styles */
.form-row input[type="text"],
input[type="submit"] {
   font-family: 'Roboto', sans-serif;
}

.submit-btn {
    float: right;
}

.submit-btn input[type="submit"] {
    background-color: #22254E;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s; 
    width: 1200px; 
    margin-top: 10px; 
}

.submit-btn input[type="submit"]:hover {
    background-color: #CEDDF4;
}

.form-row:nth-child(even),
.form-row:nth-child(odd) {
    background-color: #f2f2f2;
    border-radius: 5px; 
}

.form-row:hover {
    background-color: #BCBAC5;
}

.form-row {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.form-row label {
    width: 250px;
    flex: 0 0 250px;
    font-size: 18px;
    margin-bottom: 0;
    padding-left: 5px; 
}

.form-row input[type="text"] {
    width: calc(100% - 200px);
    height: 40px;
    font-size: 16px;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
    float: right;
    margin-right: 1px; 
}

@media (min-width: 768px) {
    .form-row input[type="text"] {
        width: calc(100% - 200px);
        margin-right: 1px;
    }

    .form-row:last-child input[type="text"] {
        margin-right: 0;
    }

    .submit-btn input[type="submit"] {
        width: 1200px; 
        margin-top: 0;
    }
}

/* New styles for message */
.message-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh; /* Adjust height as needed */
    text-align: center;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 20px auto; /* Center horizontally */
    width: 50%; /* Decrease width */
}

.message-container h1 {
    font-size: 24px;
    color: #333;
}
</style>
