<?php include('../config.php'); ?>
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
		<?php if ($_SERVER['SCRIPT_NAME'] == '/index.php'): ?>
			<button class="login-signup-btn">Log In / Sign Up</button>
		<?php endif; ?>
	</div>
    </header>

