<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Navigation</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <style>
            @import url('https://fonts.googleapis.com/css?family=Montserrat');

            .sidenav {
                height: 100%;
                width: 220px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #1E2134;
                overflow-x: hidden;
                padding-top: 50px;
                text-align: center;
            }

            .logo img {
                width: 200px;
                height: auto;
                margin-bottom: 20px;
            }

            .sidenav a {
                padding: 12px 8px;
                text-decoration: none;
                font-size: 16px;
                color: #CEDDF4;
                display: flex;
                align-items: center;
                -webkit-transition: font-size .3s ease;
                -moz-transition: font-size .3s ease;
                -o-transition: font-size .3s ease;
                transition: font-size .3s ease;
                margin-bottom: 8px;
            }

            .sidenav a img {
                width: 32px;
                height: 32px;
                margin-right: 10px;
            }

            .sidenav a span {
                font-family: 'Roboto', sans-serif;
                padding-left: 8px;
            }

            .sidenav a:hover {
                color: #f1f1f1;
                cursor: pointer;
                font-size: 1.1em;
            }

            .main-content {
                margin-left: 120px;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <div class="sidenav">
            <div class="logo">
                <img src="Logo.png" alt="Logo">
            </div>
            <a href="index.php">
                <i class="fa fa-info-circle"></i>
                <span>Index</span>
            </a>
            <a href="modules.php">
                <i class="fa fa-graduation-cap"></i>
                <span>My Modules</span>
            </a>
            <a href="assignmodule.php">
                <i class="fa fa-desktop"></i>
                <span>Assign Module</span>
            </a>
            <a href="details.php">
                <i class="fa fa-edit"></i>
                <span>My Details</span>
            </a>
            <a href="students.php">
                <i class="fa fa-users"></i>
                <span>Students</span>
            </a>
            <a href="addstudent.php">
                <i class="fa fa-user-plus"></i>
                <span>Add Student</span>
            </a>
            <a href="logout.php">
                <i class="fa fa-power-off"></i>
                <span>Logout</span>
            </a>
        </div>
    </body>
</html>
