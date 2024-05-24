<?php
    // Includes neccessary configuration, functions and database conection files
    include("_includes/config.inc");
    include("_includes/dbconnect.inc"); 
    include("_includes/functions.inc"); 

    // Check if the user is logged in, 
    // if they are logged in they can see the content
    if (isset($_SESSION['id'])) {
        // Build SQL statement to select a student's modules
        $sql = "SELECT * FROM studentmodules sm, module m 
        WHERE m.modulecode = sm.modulecode AND 
        sm.studentid = '" . $_SESSION['id'] ."';";
        // Exwcutes the sql query
        $result = mysqli_query($conn, $sql);

        // Prepares table content
        $tableContent = "<table class='module-table'>";
        $tableContent .= "<tbody><tr><th>Code</th><th>Type</th><th>Level</th></tr>";
        
        // Display the modules assigned with the student inside html table
        while($row = mysqli_fetch_array($result)) {
            $tableContent .= "<tr><td> $row[modulecode] </td><td> $row[name] </td>";
            $tableContent .= "<td> $row[level] </td></tr>";
        }
        $tableContent .= "</tbody></table>";

        // includes templates
        echo template("templates/partials/header.php"); 
        echo template("templates/partials/nav.php"); //
        echo "
        <div class='table-wrapper'>
            <div class='table-container'>
                <h1 class='modules-heading'>MY CURRENT MODULES</h1> <!-- Heading above the table -->
                $tableContent <!-- Table content -->
            </div>
        </div>"; 
    } else {
        // if user isnt logged in they will be redirected to lofin page
        header("Location: index.php");
    }

?>


<style>
    /* CSS Styles */
    body {
        font-family: 'Roboto', sans-serif; 
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f4f4f4; 
    }

    .table-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 100%;
    }

    /* Actual styling for the table*/
    .module-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
        font-family: 'Roboto', sans-serif; 
        border-radius: 10px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden; 
        background-color: #fff; 
    }

    .module-table th, .module-table td {
        padding: 12px;
        text-align: left;
        transition: background-color 0.3s; 
    }

    .module-table th {
        background-color: #f2f2f2;
        font-size: 18px;
        border-bottom: 2px solid #ddd;
    }

    .module-table td {
        font-size: 16px;
        border-bottom: 1px solid #ddd;
    }

    /* Add alternating row colors */
    .module-table tbody tr:nth-child(even) {
        background-color: #fafafa;
    }

    .module-table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }

    /* hover effect */
    .module-table tbody tr:hover {
        background-color: #e0e0e0;
    }

    /* Container which holds the table */
    .table-container {
        max-width: 1400px; 
        margin-left: 100px; 
        padding: 20px;
        background-color: #fff; 
        border-radius: 10px; 
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2); 
        text-align: center;
    }

    /* Module heading styles */
    .modules-heading {
        font-size: 40px; 
        margin-bottom: 20px; 
        color: #333; 
    }

</style>
