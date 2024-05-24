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

        // Sanitize user inputs to prevent SQL injection
        $firstname = mysqli_real_escape_string($conn, $_POST['txtfirstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['txtlastname']);
        $house = mysqli_real_escape_string($conn, $_POST['txthouse']);
        $town = mysqli_real_escape_string($conn, $_POST['txttown']);
        $county = mysqli_real_escape_string($conn, $_POST['txtcounty']);
        $country = mysqli_real_escape_string($conn, $_POST['txtcountry']);
        $postcode = mysqli_real_escape_string($conn, $_POST['txtpostcode']);
        $studentid = mysqli_real_escape_string($conn, $_SESSION['id']);

        // Build an SQL statement to update the student details
        $sql = "UPDATE student SET 
            firstname = '$firstname',
            lastname = '$lastname',
            house = '$house',
            town = '$town',
            county = '$county',
            country = '$country',
            postcode = '$postcode' 
            WHERE studentid = '$studentid';";
        $result = mysqli_query($conn, $sql);

        $data['content'] = "<div class='message-container'><h1>Your details have been updated</h1></div>";

    } else {
        // Build an SQL statement to return the student record with the id that matches that of the session variable
        $studentid = mysqli_real_escape_string($conn, $_SESSION['id']);
        $sql = "SELECT * FROM student WHERE studentid='$studentid';";
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
                        <label for="txttown"><i class="fas fa-map"></i> Town:</label>
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

    echo template("templates/default.php", $data);

    } else {
    header("Location: index.php");
    }
?>

<style>
    /* General Styles */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 0 20px;
    }

    /* Form Styles */
    .form-container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .form-row {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .form-row label {
        width: 200px;
        flex: 0 0 200px;
        font-size: 18px;
        margin-bottom: 0;
    }

    .form-row input[type="text"] {
        flex: 1;
        height: 40px;
        font-size: 16px;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Button Styles */
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
        width: 98.5%;
    }

    .submit-btn input[type="submit"]:hover {
        background-color: #CEDDF4;
    }

    /* Message Styles */
    .message-container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 20px auto;
        width: 400px; 
        height: 250px; 
        position: absolute; 
        top: 50%;
        left: 55%;
        transform: translate(-50%, -50%); 
        display: flex;
        justify-content: center;
        align-items: center; /
    }

    .message-container h1 {
        font-size: 24px;
        color: #333;
    }

</style>