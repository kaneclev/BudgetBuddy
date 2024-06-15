<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Buddy</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
    <header class="main-header">
	<div class="header-content">
        	<h1>Budget Buddy</h1>
		<?php if ($_SERVER['SCRIPT_NAME'] == '/index.php'): ?>
			<button class="login-signup-btn">Log In / Sign Up</button>
		<?php endif; ?>
	</div>
    </header>

