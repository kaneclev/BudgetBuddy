<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Buddy</title>
    <base href="/cs2450/">
    <link rel="stylesheet" href="<?php echo CUSTOM_CSS;?>">
    <link rel="stylesheet" href="<?php echo TABLET_CSS;?>">
    <link rel="stylesheet" href="<?php echo PHONE_CSS;?>">
</head>
<body>
    <header class="main-header">
	<div class="header-content">
        	<h1>Budget Buddy</h1>
	        <?php
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                    echo '<a href="accounts/logout-handler.php" id="logout-btn" class="button">Logout</a>';
                } else {
                    echo '<a href="/cs2450/accounts/login.php" id="login-signup-btn" class="button">Login</a>';
                }
            ?>
	</div>
    </header>

