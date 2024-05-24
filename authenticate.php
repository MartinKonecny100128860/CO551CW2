<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    session_start();
    //sanitize user inputn to prevent malicious attacks such as sql injections.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $studentid = mysqli_real_escape_string($conn, $_POST['txtid']);
        $password = mysqli_real_escape_string($conn, $_POST['txtpwd']);

        // Check user credentials
        $sql = "SELECT * FROM student WHERE studentid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $studentid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // User exists, check password
            if (password_verify($password, $row['password'])) {
                // Successful login
                $_SESSION['id'] = $row['studentid'];
                header("Location: index.php");
                exit;
            } else {
                // Incorrect password
                $error_message = "Incorrect password.";
            }
        } else {
            // User does not exist
            $error_message = "User does not exist.";
        }

        // Redirect to error.php with error message
        header("Location: error.php?error=" . urlencode($error_message));
        exit;
    }
?>
