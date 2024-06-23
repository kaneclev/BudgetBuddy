<?php
include($_SERVER['DOCUMENT_ROOT'] . '/cs2450/config.php');
include(ROOT_PATH . 'includes/top.php');

session_start();
$errors = [];

?>
    <main id="content">
	<?php
    if (isset($_SESSION['signup_error'])) {
        echo '<div class="error-container">';
        foreach ($_SESSION['signup_error'] as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo '</div>';
        unset($_SESSION['signup_error']);
    }

	if (isset($_SESSION['login_error'])) {
        echo '<div class="error-container">';
        foreach ($_SESSION['login_error'] as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo '</div>';
        unset($_SESSION['login_error']); 
    }
	?>

	
        <div class="login-container">
            <h2>Log In</h2>
			<div class="error"></div>
			<?php
				include(ROOT_PATH . 'includes/form.php');
				renderFormStart('loginForm', 'accounts/login.php', 'POST'); // use form.php to start the form
				renderTextInputField('text', 'username', 'username', 'Username:');
				renderTextInputField('password', 'password', 'password', 'Password:');
				renderFormEnd('Log In');
			?>   
        </div>
		<div class="or-container"> 
			<span>-OR-</span>
		</div>
		<div class="signup-container">
			<h2>Sign Up</h2>
			<?php if (isset($signup_error)): ?>
				<p class="error"><?php echo $signup_error; ?></p>
			<?php endif; ?>
			<?php 
				renderFormStart('signupForm', 'accounts/login.php', 'POST');
				renderTextInputField('text', 'username_signup', 'username_signup', 'Username:');
				renderTextInputField('password', 'password_signup', 'password_signup', 'Password:');
				renderTextInputField('password', 'confirm_password_signup', 'confirm_password_signup', 'Confirm Password:');
				renderFormEnd('Sign Up');	
			?>
		</div>
	
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="accounts/login.js"></script>
	<script src="accounts/signup.js"></script>
	</main>
<?php include(ROOT_PATH . 'includes/footer.php'); ?>

