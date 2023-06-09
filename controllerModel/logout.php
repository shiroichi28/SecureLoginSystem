<?php

session_start();

// Clear all session data
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header('Location: ../views/login');
exit();
?>
