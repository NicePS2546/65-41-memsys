<?php
session_start(); // Start the session
unset($_SESSION["role"]); //reference
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: login.php"); // Redirect to the login page
exit(); //ensure code exit code
