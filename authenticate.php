<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentid = mysqli_real_escape_string($conn, $_POST['txtid']);
    $password = mysqli_real_escape_string($conn, $_POST['txtpwd']);

    // Check user credentials
    $sql = "SELECT * FROM student WHERE studentid = '$studentid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        // Successful login
        $_SESSION['id'] = $row['studentid'];
        header("Location: index.php");
        exit;
    } else {
        // Invalid credentials
        $message = "Invalid Student ID or Password.";
        header("Location: login.php?error=" . urlencode($message));
        exit;
    }
}
?>

