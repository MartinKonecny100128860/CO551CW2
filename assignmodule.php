<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // check logged in
    if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // If a module has been selected
    if (isset($_POST['selmodule'])) {
        $sql = "insert into studentmodules values ('" .  $_SESSION['id'] . "','" . $_POST['selmodule'] . "');";
        $result = mysqli_query($conn, $sql);
        $data['content'] .= "<p>The module " . $_POST['selmodule'] . " has been assigned to you</p>";
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

    // render the template
    echo template("templates/default.php", $data);

    } else {
    header("Location: index.php");
    }

    echo template("templates/partials/footer.php");

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

.form-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 600px; /* Enlarged width */
    width: 100%;
    padding: 40px; /* Increased padding */
    border: 1px solid #ddd;
    border-radius: 10px; /* More rounded corners */
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    margin-left: -60px
}

.form-container:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

label {
    font-size: 24px; /* Enlarged font size */
    margin-bottom: 20px;
    width: 100%;
    text-align: left;
}

select {
    width: 100%;
    padding: 16px; /* Increased padding */
    margin-bottom: 20px; /* Reduced margin-bottom */
    margin-top: 10px; /* Added margin-top for more space */
    border: 1px solid #ddd;
    border-radius: 8px; /* More rounded corners */
    font-size: 20px; /* Increased font size */
    background-color: #fafafa;
    transition: border-color 0.3s ease;
}

select:focus {
    border-color: #4CAF50;
    outline: none;
}

input[type='submit'] {
    width: 100%;
    padding: 16px; /* Increased padding */
    margin-top: 10px; /* Added margin-top to move the button slightly above */
    border: none;
    border-radius: 8px; /* More rounded corners */
    background-color: #22254E;
    color: white;
    font-size: 20px; /* Increased font size */
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type='submit']:hover {
    background-color: #CEDDF4;
}

/* Media Queries for Responsiveness */
@media (max-width: 600px) {
    .form-container {
        padding: 30px;
    }

    label, select, input[type='submit'] {
        font-size: 18px;
    }
}
</style>