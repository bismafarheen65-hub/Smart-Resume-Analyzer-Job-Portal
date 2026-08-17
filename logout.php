<?php

session_start();
include("config/db.php");

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

    // Delete related records first
    mysqli_query($conn, "DELETE FROM resume_analysis WHERE User_ID='$user_id'");
    mysqli_query($conn, "DELETE FROM applications WHERE User_ID='$user_id'");
    mysqli_query($conn, "DELETE FROM certifications WHERE User_ID='$user_id'");
    mysqli_query($conn, "DELETE FROM education WHERE User_ID='$user_id'");
    mysqli_query($conn, "DELETE FROM experience WHERE User_ID='$user_id'");
    mysqli_query($conn, "DELETE FROM projects WHERE User_ID='$user_id'");
    mysqli_query($conn, "DELETE FROM skills WHERE User_ID='$user_id'");
    mysqli_query($conn, "DELETE FROM cv WHERE User_ID='$user_id'");
    mysqli_query($conn, "DELETE FROM resume WHERE User_ID='$user_id'");

    // Finally delete the user account
    mysqli_query($conn, "DELETE FROM users WHERE User_ID='$user_id'");
}

// Destroy session
session_unset();
session_destroy();

// Redirect to registration page
header("Location: register.php");
exit();

?>