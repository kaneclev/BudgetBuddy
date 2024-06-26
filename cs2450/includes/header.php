<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Buddy</title>
	<link rel="icon" type="image/png" href="/cs2450/design/budgetbuddyicon.png">
	<base href="/cs2450/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo CUSTOM_CSS;?>">
    <link rel="stylesheet" href="<?php echo TABLET_CSS;?>">
    <link rel="stylesheet" href="<?php echo PHONE_CSS;?>">
</head>
<body>
    <header class="header main-header">
	<div class="header__content">
        	<h1 class="header__title">Budget Buddy</h1>	
            <?php
                // Get the current page URL
                $current_page = basename($_SERVER['PHP_SELF']);

                // Define the login page URL
                $login_page = 'login.php';

                // Check if the current page is not the login page
                if ($current_page !== $login_page) {
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                        echo '<a href="accounts/logout-handler.php" id="logout-btn" class="button login__button">Logout</a>';
                    } else {
                        echo '<a href="/cs2450/accounts/login.php" id="login-signup-btn" class="button login__button">Login</a>';
                    }
                }
            ?>
        </div>
    </header>

