<?php
// logout.php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the sign-in page
header("Location: ../pages/signin.php");
exit;