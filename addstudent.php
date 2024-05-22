<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // check logged in
    if (isset($_SESSION['id'])) {
        echo template("templates/partials/header.php");
        echo template("templates/partials/nav.php");
?>

<div class="main-contents">
    <h1>Add Student</h1>
    <form name="frmdetails" action="addstudentsql.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <label for="studentid"><i class="fa fa-id-card"></i> Student ID:</label>
            <input name="studentid" type="text" required />
            <span class="error-message" id="studentid-error"></span>
        </div>
        <div class="form-row">
            <label for="password"><i class="fas fa-lock"></i> Password:</label>
            <input name="password" type="password" required />
        </div>
        <div class="form-row">
            <label for="dob"><i class="fas fa-calendar"></i> Date of Birth:</label>
            <input name="dob" type="date" placeholder="YYYY-MM-DD" required />
        </div>
        <div class="form-row">
            <label for="firstname"><i class="fas fa-user"></i> First Name:</label>
            <input name="firstname" type="text" required />
            <span class="error-message" id="firstname-error"></span>
        </div>
        <div class="form-row">
            <label for="lastname"><i class="fas fa-user"></i> Last Name:</label>
            <input name="lastname" type="text" required />
            <span class="error-message" id="lastname-error"></span>
        </div>
        <div class="form-row">
            <label for="house"><i class="fas fa-home"></i> Address:</label>
            <input name="house" type="text" required />
        </div>
        <div class="form-row">
            <label for="town"><i class="fas fa-map-marker-alt"></i> Town/City:</label>
            <input name="town" type="text" required />
        </div>
        <div class="form-row">
            <label for="county"><i class="fas fa-map-marker-alt"></i> County:</label>
            <input name="county" type="text" required />
        </div>
        <div class="form-row">
            <label for="country"><i class="fas fa-globe"></i> Country:</label>
            <input name="country" type="text" required />
        </div>
        <div class="form-row">
            <label for="postcode"><i class="fas fa-envelope"></i> Postcode:</label>
            <input name="postcode" type="text" required />
        </div>
        <div class="form-row">
            <label for="image"><i class="fas fa-image"></i> Upload Image:</label><br>
            <input type="file" id="image" name="image" accept="image/*">
        </div>
        <div class="form-row submit-btn">
            <input type="submit" value="Submit" />
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

            if (!valid) {
                event.preventDefault(); // Prevent form submission if invalid
            }
        });
    });
</script>



<style> 

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }

    .form-row input[type="text"],
    input[type="submit"] {
       font-family: 'Roboto', sans-serif;
    }

    .submit-btn {
        float: right;
    }

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
        width: 1200px; 
        margin-top: 10px; 
    }

    .submit-btn input[type="submit"]:hover {
        background-color: #CEDDF4;
    }

    .form-row:nth-child(even),
    .form-row:nth-child(odd) {
        background-color: #f2f2f2;
        border-radius: 5px; 
    }

    .form-row:hover {
        background-color: #BCBAC5;
    }

    .form-row {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .form-row label {
        width: 200px;
        font-size: 18px;
        margin-bottom: 0;
        padding-left: 5px; 
    }

    .form-row input[type="text"],
    .form-row input[type="password"],
    .form-row input[type="date"],
    .form-row input[type="file"] {
        width: calc(100% - 200px);
        height: 40px;
        font-size: 16px;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
        float: right;
        margin-right: 1px; 
    }

    @media (min-width: 768px) {
        .form-row input[type="text"] {
            width: calc(100% - 200px);
            margin-right: 1px;
        }

        .form-row:last-child input[type="text"] {
            margin-right: 0;
        }

        .submit-btn input[type="submit"] {
            width: 1200px; 
            margin-top: 0;
        }
    }

    .main-contents {
        margin-left: 262px;
        padding: 20px;
        font-family: 'Roboto', sans-serif;
    }
</style>