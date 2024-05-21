<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    $message = "";
    // Check if any students were selected to be deleted
    if (isset($_POST['students']) && is_array($_POST['students'])) {
        // Loop through selected students and delete them.
        foreach ($_POST['students'] as $studentid) {
            $studentid = mysqli_real_escape_string($conn, $studentid);
            $sql = "DELETE FROM student WHERE studentid = '$studentid'";
            if (mysqli_query($conn, $sql)) {
                $message .= "Student ID $studentid has been successfully deleted! <br>";
            }
        }
    }

    // Store message in session to display on students.php
    $_SESSION['delete_message'] = $message;
    header("Location: students.php");
} else {
    header("Location: index.php");
}
?>

