<?php
    // Includes neccessary configuration, functions and database conection files
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // check if logged in
    if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // If a module has been selected
    if (isset($_POST['selmodule'])) {
        // Sanitize session id and selected module to prevent SQL injection
        $studentId = mysqli_real_escape_string($conn, $_SESSION['id']);
        $selectedModule = mysqli_real_escape_string($conn, $_POST['selmodule']);

        $sql = "insert into studentmodules values ('$studentId','$selectedModule');";
        $result = mysqli_query($conn, $sql);
        $data['content'] .= "<p>The module $selectedModule has been assigned to you</p>";
    } else {

        // Build SQL statement that selects all the modules
        $sql = "select * from module";
        $result = mysqli_query($conn, $sql);

        $data['content'] .= "<div class='form-container'>";
        $data['content'] .= "<form name='frmassignmodule' action='' method='post' >";
        $data['content'] .= "<label for='selmodule'>Select a module to assign</label><br/>";
        $data['content'] .= "<select name='selmodule' id='selmodule' >";
        // Display the module names in a drop down selection box
        while ($row = mysqli_fetch_array($result)) {
            $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
        }
        $data['content'] .= "</select><br/>";
        $data['content'] .= "<input type='submit' name='confirm' value='Save' />";
        $data['content'] .= "</form>";
        $data['content'] .= "</div>";
    }

    // includes templates
    echo template("templates/default.php", $data);

    // if user isnt logged in they will be redirected to lofin page
    } else {
    header("Location: index.php");
    }

?>


<style>
    /* CSS Styles */
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Container which holds the drop down with modules*/ 
    .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 600px;
        width: 100%;
        padding: 40px;
        border: 1px solid #ddd;
        border-radius: 10px; 
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-left: -60px
    }

    /* Hoover effect for the drop down */
    .form-container:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    label {
        font-size: 24px;
        margin-bottom: 20px;
        width: 100%;
        text-align: left;
    }

    select {
        width: 100%;
        padding: 16px; 
        margin-bottom: 20px;
        margin-top: 10px;
        border: 1px solid #ddd;
        border-radius: 8px; 
        font-size: 20px;
        background-color: #fafafa;
        transition: border-color 0.3s ease;
    }

    select:focus {
        border-color: #4CAF50;
        outline: none;
    }

    /* Button styles */ 
    input[type='submit'] {
        width: 100%;
        padding: 16px; 
        margin-top: 10px; 
        border: none;
        border-radius: 8px;
        background-color: #22254E;
        color: white;
        font-size: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type='submit']:hover {
        background-color: #CEDDF4;
    }
</style>