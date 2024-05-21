    <?php
    // Define a simple template function
    function template($template_path, $data) {
        ob_start();
        include $template_path;
        return ob_get_clean();
    }

    // Now you can include your header and navigation templates
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");

    // Include header and navigation template
    echo template("templates/partials/header.php", $data);
    echo template("templates/partials/nav.php", $data);
        // Get form data
        ?>
        <div class="main-content" style="margin-left: 240px; font-family: 'Roboto', sans-serif; font-size: 18px; background-color: #f4f4f4;">
        <?php
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
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file is an actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // If everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
                // Insert student data into the database
                // Remember to store the file path ($targetFile) in the database
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into student table
        $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode) 
        VALUES ('$studentid', '$hashedPassword', '$dob', '$firstname', '$lastname', '$house', '$town', '$county', '$country', '$postcode')";

        // Execute SQL query
        if (mysqli_query($conn, $sql)) {
            echo "Student added successfully.";
        } else {
            echo "Error adding student: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    ?>
    </div>
