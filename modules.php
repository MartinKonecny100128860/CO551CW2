<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Build SQL statement to select a student's modules
    $sql = "SELECT * FROM studentmodules sm, module m WHERE m.modulecode = sm.modulecode AND sm.studentid = '" . $_SESSION['id'] ."';";
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

    // Render the template with the centered table and navbar
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");
    echo "
    <div class='table-container' style='margin-top: 100px; margin-left: 450px;'>
        <h1 class='modules-heading'>MY CURRENT MODULES</h1> <!-- Heading above the table -->
        $tableContent
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
}

.module-table {
    width: 100%;
    border-collapse: collapse;
    border: 2px solid #ddd;
    margin: 0 auto;
    font-family: 'Roboto', sans-serif; /* Add font family */
}

.module-table th, .module-table td {
    padding: 12px;
    text-align: left;
}

.module-table th {
    background-color: #f2f2f2;
    font-size: 18px;
}

.module-table td {
    font-size: 16px;
    border-bottom: 1px solid #ddd;
}

/* Add hover effect */
.module-table tbody tr:hover {
    background-color: #BCBAC5;
}

.table-container {
    max-width: 800px;
    margin: 70px auto; /* Adjust top margin */
    overflow-x: auto;
    text-align: center; /* Center the heading */
}

.modules-heading {
    font-size: 40px; /* Heading font size */
    margin-bottom: 20px; /* Space between heading and table */
}
</style>
