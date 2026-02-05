<?php
session_start();

// Define your secret token
$ADMIN_TOKEN = "111666";

// If the user isn't logged in, send them to the login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin");
    exit;
}
?>