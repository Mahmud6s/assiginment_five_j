<?php
session_start();

// Logout Handling
if (isset($_GET['logout'])) {
    // Unset all of the session
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    header("Location: login.php");
    exit();
}
?>
