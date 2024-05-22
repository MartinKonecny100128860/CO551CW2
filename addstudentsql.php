<?php

    function template($template_path, $data) {
        ob_start();
        include $template_path;
        return ob_get_clean();
    }

    include("_includes/config.inc");
    include("_includes/dbconnect.inc");

    echo template("templates/partials/header.php", $data);
    echo template("templates/partials/nav.php", $data);
?>

<div class="main-content" style="margin-left: 240px; font-family: 'Roboto', sans-serif; font-size: 18px; background-color: #f4f4f4;"> 
    <?php
    // // Sanitize and escape user input to prevent SQL injection attacks
    $studentid = mysqli_real_escape_string($conn, $_POST['studentid']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $house = mysqli_real_escape_string($conn, $_POST['house']);
    $town = mysqli_real_escape_string($conn, $_POST['town']);
    $county = mysqli_real_escape_string($conn, $_POST['county']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);

    // File upload
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    $imageData = mysqli_real_escape_string($conn, $imageData); // real escape string to prevent sql attacks

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into student table
    $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, image_path) 
            VALUES ('$studentid', '$hashedPassword', '$dob', '$firstname', '$lastname', '$house', '$town', '$county', '$country', '$postcode', '$imageData')";

    // Execute SQL query
    if (mysqli_query($conn, $sql)) {
        // Display message for student addition
        echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;'>";
        echo "<p>Student has been added.</p>";
        echo "</div>";
    } else {
        echo "Error adding student: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>
</div>



