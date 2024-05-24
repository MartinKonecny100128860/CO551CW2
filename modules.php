<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Build SQL statement to select a student's modules
    $sql = "SELECT * FROM studentmodules sm, module m 
    WHERE m.modulecode = sm.modulecode AND 
    sm.studentid = '" . $_SESSION['id'] ."';";
    $result = mysqli_query($conn, $sql);

    // Prepare table content
    $tableContent = "<table class='module-table'>";
    $tableContent .= "<tbody><tr><th>Code</th><th>Type</th><th>Level</th></tr>";
    
    // Display the modules within the HTML table
    while($row = mysqli_fetch_array($result)) {
        $tableContent .= "<tr><td> $row[modulecode] </td><td> $row[name] </td>";
        $tableContent .= "<td> $row[level] </td></tr>";
    }
    $tableContent .= "</tbody></table>";

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");
    echo "
    <div class='table-wrapper'>
        <div class='table-container'>
            <h1 class='modules-heading'>MY CURRENT MODULES</h1> <!-- Heading above the table -->
            $tableContent
        </div>
    </div>";
} else {
    header("Location: index.php");
}

// Include footer template
echo template("templates/partials/footer.php");
?>

<style>
/* CSS Styles */
body {
    font-family: 'Roboto', sans-serif; /* Add font family */
    margin: 0;
    height: 100vh; /* Full height */
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f4f4f4; /* Updated background color */
}

.table-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
}

.module-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
    font-family: 'Roboto', sans-serif; /* Add font family */
    border-radius: 10px; /* Round edges of the table */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
    overflow: hidden; /* Clip children to rounded corners */
    background-color: #fff; /* Updated background color */
}

.module-table th, .module-table td {
    padding: 12px;
    text-align: left;
    transition: background-color 0.3s; /* Smooth transition for background color */
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

/* Add hover effect */
.module-table tbody tr:hover {
    background-color: #e0e0e0;
}

.table-container {
    max-width: 1400px; /* Increase max-width for a wider box */
    margin-left: 100px; /* Move the table container slightly to the right */
    padding: 20px;
    background-color: #fff; /* Background color for container */
    border-radius: 10px; /* Rounded corners for container */
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2); /* Shadow for container */
    text-align: center; /* Center the heading */
}

.modules-heading {
    font-size: 40px; /* Heading font size */
    margin-bottom: 20px; /* Space between heading and table */
    color: #333; /* Color for heading */
}

</style>
