<?php
/*
	This short file is dedicated to logging out.
	logout-handler.php will only be accessible if the
	logged_in session variable is true. Although the logout button
	which causes this code to execute should only be executed when the 
	logout button is pressed (which should only be present if logged_in is true),
	the if statement is a failsafe in case someone might try to manually navigate to this
	page. 

*/
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
	session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: /cs2450/accounts/login.php"); // Redirect to login page
	exit();
} else {
    header("Location: /cs2450/accounts/login.php"); // Redirect to login page if not logged in
    exit();
}
?>

