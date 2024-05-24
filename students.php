<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// This block of code checks if the admin / user is logged in
// if the user isn't logged in, they will be redirected to login page
// they must be logged in to view the table with all the students. 
if (isset($_SESSION['id'])) {
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Display feedback message
    if (isset($_SESSION['delete_message'])) {
        echo "<p class='error-message'>{$_SESSION['delete_message']}</p>";
        unset($_SESSION['delete_message']); // Clear message after displaying
    }

    $sql = "SELECT * FROM student";
    $result = mysqli_query($conn, $sql);

    // Check if any records were returned from the database query
    if (mysqli_num_rows($result) > 0) {
        $data['content'] = "<div class='table-container'>";
        $data['content'] .= "<h2>Student Records</h2>";
        $data['content'] .= "<form action='deletestudents.php' method='post'>";
        $data['content'] .= "<table>";
        $data['content'] .= "<tr>
                                <th>Select</th>
                                <th>Student ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date of Birth</th>
                                <th>House</th>
                                <th>Town</th>
                                <th>County</th>
                                <th>Country</th>
                                <th>Postcode</th>
                                <th>Image</th>
                            </tr>";
        // Fetch each record as an associative array
        while ($row = mysqli_fetch_assoc($result)) {
            $imageData = base64_encode($row['image_path']);
            $data['content'] .= 
            "<tr>
                <td><input type='checkbox' name='students[]' value='{$row['studentid']}'></td>
                <td>{$row['studentid']}</td>
                <td>{$row['firstname']}</td>
                <td>{$row['lastname']}</td>
                <td>{$row['dob']}</td>
                <td>{$row['house']}</td>
                <td>{$row['town']}</td>
                <td>{$row['county']}</td>
                <td>{$row['country']}</td>
                <td>{$row['postcode']}</td>
                <td><img src='data:image/jpeg;base64,{$imageData}' alt='Student Image' style='width: 50px; height: auto;'></td>
            </tr>";
        }

        $data['content'] .= "</table>";
        $data['content'] .= "<div class='button-container'>";
        $data['content'] .= "<input type='submit' value='Delete Selected' onclick='return confirm(\"Are you sure you want to delete the selected students?\");' class='delete-button'>";
        $data['content'] .= "</div>";
        $data['content'] .= "</form>";
        $data['content'] .= "</div>";
    } else {
        $data['content'] = "<p>No student records found.</p>";
    }
    // Outputs the final table by using a template to render the page
    echo template("templates/default.php", $data);
} else {
    header("Location: index.php");
}

echo template("templates/partials/footer.php");
?>


<style>
    /* CSS Styles for table container */
    .table-container {
        max-width: 90%;
        margin: 0 auto;
        overflow-x: auto;
        padding: 20px;
        margin-left: 100px; /* Adjusted margin-left */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background: #fff;
        border-radius: 8px;
        font-family: 'Roboto', sans-serif; /* Apply Roboto font */
    }

    /* Additional CSS styles for the table */
    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
        margin-top: 20px;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
    }

    th {
        background-color: #f2f2f2;
        position: sticky;
        top: 0;
        z-index: 2;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    tr:hover {
        background-color: #BCBAC5;
        transition: background-color 0.3s ease;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        th, td {
            font-size: 12px;
            padding: 4px;
        }

        th, td:nth-child(n+6) {
            display: none;
        }

        td img {
            width: 30px;
            height: auto;
        }
    }

    @media (max-width: 480px) {
        th, td {
            font-size: 10px;
            padding: 2px;
        }

        th, td:nth-child(n+4) {
            display: none;
        }

        td img {
            width: 20px;
            height: auto;
        }
    }

    /* Styles for the submit button */
    .delete-button {
        background-color: #22254E;
        color: white;
        padding: 12px 200px; /* Adjusted padding for wider button */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: block;
        margin: 20px auto 0;
        width: auto; /* Adjusted width to auto */
        font-family: 'Roboto', sans-serif;
        font-size: 15px;
    }

    .delete-button:hover {
        background-color: #CEDDF4;
    }

    /* Styles for error message */
    .error-message {
        color: red;
        margin-top: 10px;
        text-align: center;
        font-family: 'Roboto', sans-serif;
        font-size: 20px;
    }
</style>