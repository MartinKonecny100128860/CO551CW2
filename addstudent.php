<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // check logged in
    if (isset($_SESSION['id'])) {
        echo template("templates/partials/header.php");
        echo template("templates/partials/nav.php");
?>

<!-- Page header -->
<div class="main-contents">
    <!-- Header section with pink background -->
    <div class="page-header" style="background-color: #f4f4f4; text-align: center; padding: 20px; margin-top: -20px; width: calc(100% + 240px); margin-left: -240px; padding-left: 10px;">
    <h1>ADD NEW STUDENT</h1>
</div>
    <!-- End of header section -->

    <!-- Form for adding a student -->
    <form name="frmdetails" action="addstudentsql.php" method="post" enctype="multipart/form-data">
        <div class="form-container">
            <!-- Row containing the image upload section and form fields -->
            <div class="form-row">
                <!-- Image upload section styled as a square -->
                <div class="image-upload-square" style="margin-top: 25px;">
                    <img id="image-preview" style="display:none; width: 100%; height: 100%; object-fit: cover; border-radius: 10px;" />
                    <label for="image" class="image-label" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;"><i class="fas fa-image"></i> Upload Image</label>
                    <input type="file" id="image" name="image" accept="image/jpeg, image/png" required style="display: none;" />
                    <button type="button" id="remove-image" style="display: none; position: absolute; bottom: 10px;">Remove</button>
                </div>

                <!-- Form fields container -->
                <div class="form-fields-container">
                    <!-- First row of form columns -->
                    <div class="form-column">
                        <label for="studentid"><i class="fa fa-id-card"></i> Student ID:</label>
                        <input name="studentid" type="text" required />
                        <span class="error-message" id="studentid-error"></span>
                    </div>
                    <div class="form-column">
                        <label for="password"><i class="fas fa-lock"></i> Password:</label>
                        <input name="password" type="password" required />
                    </div>
                    <!-- Second row of form columns -->
                    <div class="form-column">
                        <label for="firstname"><i class="fas fa-user"></i> First Name:</label>
                        <input name="firstname" type="text" required />
                        <span class="error-message" id="firstname-error"></span>
                    </div>
                    <div class="form-column">
                        <label for="lastname"><i class="fas fa-user"></i> Last Name:</label>
                        <input name="lastname" type="text" required />
                        <span class="error-message" id="lastname-error"></span>
                    </div>
                    <!-- Third row of form columns -->
                    <div class="form-column">
                        <label for="dob"><i class="fas fa-calendar"></i> Date of Birth:</label>
                        <input name="dob" type="date" placeholder="YYYY-MM-DD" required />
                        <span class="error-message" id="dob-error"></span>
                    </div>
                    <div class="form-column">
                        <label for="house"><i class="fas fa-home"></i> Address:</label>
                        <input name="house" type="text" required />
                    </div>
                </div>
            </div>

            <!-- New row for Postcode, County, and Country -->
            <div class="form-row">
                <div class="form-column small-column postcode-column" style="width: 30%;"> <!-- Adjusted width -->
                    <label for="town"><i class="fas fa-map"></i> Town:</label>
                    <input name="town" type="text" required />
                </div>
                <div class="form-column small-column postcode-column" style="width: 20%;"> <!-- Adjusted width -->
                    <label for="postcode"><i class="fas fa-envelope"></i> Postcode:</label>
                    <input name="postcode" type="text" required />
                </div>
                <div class="form-column county-column" style="width: 20%;"> <!-- Adjusted width -->
                    <label for="county"><i class="fas fa-map-marker-alt"></i> County:</label>
                    <input name="county" type="text" required />
                </div>
                <div class="form-column country-column" style="width: 20%;"> <!-- Adjusted width -->
                    <label for="country"><i class="fas fa-globe"></i> Country:</label>
                    <input name="country" type="text" required />
                </div>
            </div>

            <!-- Submit button -->
            <div class="form-row submit-btn">
                <input type="submit" value="Submit" />
            </div>
        </div>
    </form>
</div>

<?php
    echo template("templates/default.php", $data);
    } else {    
        header("Location: index.php");
    }

    echo template("templates/partials/footer.php");
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.forms['frmdetails'];

        // Image preview functionality
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const imageLabel = document.querySelector('.image-label');

        const removeImageButton = document.getElementById('remove-image');
        // Display image preview when image is selected
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    imageLabel.style.display = 'none';
                    removeImageButton.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
        // Remove the image preview when remove button is clicked
        removeImageButton.addEventListener('click', function() {
            imageInput.value = '';
            imagePreview.src = '';
            imagePreview.style.display = 'none';
            imageLabel.style.display = 'flex';
            removeImageButton.style.display = 'none';
        });

        // Form validation
        form.addEventListener('submit', function(event) {
            let valid = true;

            // Clear previous error messages
            const errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(function(message) {
                message.textContent = '';
            });

            // Validate Student ID (numbers only)
            const studentid = form['studentid'].value;
            if (!/^\d+$/.test(studentid)) {
                document.getElementById('studentid-error').textContent = "Student ID must contain only numbers.";
                valid = false;
            }

            // Validate First Name (letters only)
            const firstname = form['firstname'].value;
            if (!/^[a-zA-Z]+$/.test(firstname)) {
                document.getElementById('firstname-error').textContent = "First Name must contain only letters.";
                valid = false;
            }

            // Validate Last Name (letters only)
            const lastname = form['lastname'].value;
            if (!/^[a-zA-Z]+$/.test(lastname)) {
                document.getElementById('lastname-error').textContent = "Last Name must contain only letters.";
                valid = false;
            }

            // Validate Date of Birth (not a future date or date older than 120 years)
            const dob = new Date(form['dob'].value);
            const today = new Date();
            const maxAge = new Date();
            maxAge.setFullYear(today.getFullYear() - 1900);
            if (dob > today || dob < maxAge) {
                document.getElementById('dob-error').textContent = "Date of Birth must be a valid date.";
                valid = false;
            }

            // Prevent form submission if invalid
            if (!valid) {
                event.preventDefault();
            }
        });
    });
</script>

<style>
    .postcode-column,
    .county-column,
    .country-column {
        position: relative;
        top: -10px;
    }
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }

    .submit-btn {
        text-align: center;
        margin-top: -10px;
    }

    .submit-btn input[type="submit"] {
        background-color: #22254E;
        color: white;
        border: none;
        padding: 12px 25px;
        font-size: 18px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-btn input[type="submit"]:hover {
        background-color: #CEDDF4;
    }

    .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 30px;
        margin: 45px auto; 
        width: 85%; 
        max-width: 1200px;
        background-color: #f4f4f4;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        height: 450px;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-bottom: 20px;
    }

    .form-column {
        display: flex;
        flex-direction: column;
        width: 48%;
        margin-bottom: 20px;
    }

    .form-column.small-column {
        width: 30%;
    }

    .form-row label {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .form-row input[type="text"],
    .form-row input[type="password"],
    .form-row input[type="date"],
    .form-row input[type="file"] {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
    }

    .main-contents {
        margin-left: 240px;
        padding: 0 20px;
        font-family: 'Roboto', sans-serif;
    }

    .image-upload-square {
        position: relative;
        width: 200px;
        height: 200px;
        border: 2px dashed #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        margin-right: 20px;
        margin-bottom: 50px;
        overflow: hidden;
    }

    .image-upload-square label {
        font-size: 16px;
        color: #333;
        cursor: pointer;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-upload-square input[type="file"] {
        display: none;
    }

    .form-fields-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        width: calc(100% - 220px);
    }

    #remove-image {
        background-color: #22254E;
        color: white;
        border: none;
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    #remove-image:hover {
        background-color: #CEDDF4;
    }
</style>
