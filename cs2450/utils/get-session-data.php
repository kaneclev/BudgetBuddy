<?php
/*
	get-session-data.php
	--------------------
	- Why?
		- I started trying to pass server session variables to pages like index.php
		- I realized that to do this naively, I would have to make the div tag for 'content' in 
			index.php longer and longer as I tried to echo session variables to attributes in the tag
			so that I could use them in my scripts.js file
		- This is annoying and ugly...
	- So: 
		- get-session-data.php's purpose is to provide a modular way for me to retrieve whatever session 
			variables i want throughout the execution of various js files across the site
		- For easy retrieval, I will use ajax in my js code (good opportunity to use it) as well as 
			json encoding for the session data, since the key-val setup makes it easy to pull whichever
			data i need at any point
*/

session_start();
header('Content-Type: application/json');

$response = array();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
	$response['logged_in'] = true;
	if (isset($_SESSION['username'])) {
		$response['username'] = $_SESSION['username'];
		} else {
		$response['username'] = null;
		}
	if (isset($_SESSION['user_id'])) {
			$response['user_id'] = $_SESSION['user_id'];
		} else {
			$response['user_id'] = null;
		}
	} 
else {
	$response['logged_in'] = false;	
}

// encode our map in json format and echo...
echo json_encode($response);
?>
