<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Global styles for HTML and body elements */
        html,
        body {
            height: 100%;
            font-family: 'Roboto', sans-serif;
        }

        body {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            position: relative;
        }

        /* Dark overlay on the background image */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1; 
        }

        /* Styles for the login form container */
        .login__form {
            background: #fff;
            color: #333;
            font-family: 'Roboto', sans-serif;
            border-radius: 5px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        .login__header {
            padding-top: 30px;
            text-align: center;
            margin-bottom: 60px; 
        }

        .login__title {
            font-size: 24px; 
            font-weight: 400; 
        }

        /* Main section of the login form */
        .login__main {
            max-width: 80%; 
            margin-left: auto;
            margin-right: auto; 
        }

        .login__group {
            position: relative;
        }

        .login__input {
            margin-top: 50px;
            padding: 10px 10px 10px 5px;
            color: #333;
            font-family: 'Roboto', sans-serif;
            width: 100%; 
            font-size: 16px;
            display: block;
            border: none;
            border-bottom: 1px solid #d0dce7;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .login__input:focus {
            outline: none;
        }

        .login__input:focus ~ label,
        .login__input:valid ~ label {
            top: -20px;
            font-size: 12px;
            text-transform: uppercase;
        }

        .login__label {
            color: #333;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 400; /* Normal font weight */
            position: absolute; /* Absolute positioning */
            pointer-events: none; /* Disable pointer events */
            left: 5px;
            top: 10px;
            -webkit-transition: .2s ease all; /* Smooth transition */
            transition: .2s ease all;
        }

        .login__terms {
            font-size: 14px;
            color: #a8b8c4;
            margin: 40px auto; /* Margin on top and bottom, auto on sides */
            line-height: 19px; /* Line height */
        }


        .login__terms a {
            text-decoration: none;
            color: #007ee5;
        }

        .login__button {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            width: 100%;
            background: #22254E;
            border: none;
            border-radius: 5px;
            color: #fff;
            height: 45px;
            font-size: 14px;
            bottom: 0;
            position: absolute;
        }

        .login__button:hover {
            background: #CEDDF4;
            color: #22254E;
            cursor: pointer;
        }

        .login__bar {
            position: relative;
            display: block;
        }

        .login__bar:before,
        .login__bar:after {
            content: '';
            height: 2px;
            width: 0;
            bottom: 1px;
            position: absolute;
            background: #007ee5;
            transition: .2s ease all;
            -moz-transition: .2s ease all;
            -webkit-transition: .2s ease all;
        }

        .login__bar:before {
            left: 50%;
        }

        .login__bar:after {
            right: 50%;
        }

        input:focus ~ .login__bar:before,
        input:focus ~ .login__bar:after {
            width: 50%;
        }

        @media (min-width: 620px) {
            body {
                background: url('Loginpage.jpg') no-repeat;
                background-attachment: fixed;
                background-position: center;
                background-size: cover;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
            }

            .login__form {
                max-width: 400px;
                height: 470px;
                margin-left: auto;
                margin-right: auto;
            }

            .login__title {
                position: relative;
            }

            .login__footer {
                text-align: center;
            }

            .login__footer .login__button {
                bottom: initial;
                position: initial;
                width: 320px;
            }
        }
    </style>
</head>

<body>
    <!-- Entire login box section -->
    <div class="container">
        <!-- Login Form -->
        <form class="login__form" method="POST" name="frm_login" action="authenticate.php">
            <!-- Header Section -->
            <header class="login__header">
                <h1 class="login__title">Login</h1>
            </header>
            <!-- Main Section -->
            <main class="login__main">
                <!-- Student ID Input Group -->
                <div class="login__group">
                    <input class="login__input" type="text" name="txtid" required>
                    <label class="login__label">Student ID</label>
                    <div class="login__bar"></div>
                </div>
                <!-- Password Input Group -->
                <div class="login__group">
                    <input class="login__input" type="password" name="txtpwd" required>
                    <label class="login__label">Password</label>
                    <div class="login__bar"></div>
                </div>
                <!-- Terms and Privacy Policy -->
                <p class="login__terms">
                    By Logging In, I confirm that I have read and agreed to the 
                    <a href="#">Terms</a> and 
                    <a href="#">Privacy Policy</a>
                </p>
            </main>
            <!-- Footer section of the box -->
            <footer class="login__footer">
                <input class="login__button" type="submit" name="btnlogin" value="Login">
            </footer>
        </form>
    </div>
    <!-- Bootstrap and jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
