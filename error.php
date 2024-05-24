<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('Loginpage.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            position: relative;
        }
        
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity here */
        }
        
        .error-container {
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); /* Added box shadow */
            padding: 60px 40px; /* Increased padding */
            border-radius: 8px;
            max-width: 350px;
            width: 100%;
            text-align: center;
            position: relative;
            z-index: 1; /* Ensure the container stays above the overlay */
            height: auto; /* Allow container height to adjust based on content */
        }
        
        .error-message {
            color: #ff0000;
            margin-bottom: 20px;
        }
        
        .error-notice {
            margin-top: 40px; /* Moved the paragraph lower */
            font-size: 18px; /* Enlarged the font size */
            color: #22254E; /* Set the color to red */
            font-weight: bold;
        }
        
        .back-button {
            background: #22254E;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            margin-top: 20px; /* Adjusted margin top */
            font-weight: 700;
        }
        
        .back-button:hover {
            background: #CEDDF4;
                color: #22254E;
                cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="error-container">
        <h2 class="error-message">
            <?php
            // Retrieve error message from URL parameter
            if (isset($_GET['error'])) {
                echo htmlspecialchars($_GET['error']);
            } else {
                echo "An error occurred.";
            }
            ?>
        </h2>
        <p class="error-notice">Please ensure your details are correct and try again.</p> <!-- Moved the paragraph lower -->
        <button class="back-button" onclick="goBack()">Back to Login</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>

