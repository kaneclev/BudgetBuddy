<?php
include($_SERVER['DOCUMENT_ROOT'] . '/cs2450/config.php');
include(ROOT_PATH . 'includes/top.php');

session_start();
$errors = [];

?>
    <main id="login__content">
	<?php
    if (isset($_SESSION['signup_error'])) {
        echo '<div class="login__error__container">';
        foreach ($_SESSION['signup_error'] as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo '</div>';
        unset($_SESSION['signup__error__container']);
    }

	if (isset($_SESSION['login_error'])) {
        echo '<div class="login__error__container">';
        foreach ($_SESSION['login_error'] as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo '</div>';
        unset($_SESSION['login_error']); 
    }
	?>

	
        <div class="login__container">
            <h2>Log In</h2>
			<div class="error"></div>
			<?php
				include(ROOT_PATH . 'includes/form.php');
				renderFormStart('loginForm', 'accounts/login.php', 'POST'); // use form.php to start the form
				renderTextInputField('text', 'username', 'username', 'Username:');
				renderTextInputField('password', 'password', 'password', 'Password:');
				renderFormEnd('Log In', 'login__form__button');
			?>   
        </div>
		<div class="login__separator">
		<div class="signup__container">
			<h2>Sign Up</h2>
			<div class="error"></div>
			<?php if (isset($signup_error)): ?>
			<?php endif; ?>
			<?php 
				renderFormStart('signupForm', 'accounts/login.php', 'POST');
				renderTextInputField('text', 'username_signup', 'username_signup', 'Username:');
				renderTextInputField('password', 'password_signup', 'password_signup', 'Password:');
				renderTextInputField('password', 'confirm_password_signup', 'confirm_password_signup', 'Confirm Password:');
				renderFormEnd('Sign Up', 'signup__form__button');	
			?>
		</div>
	
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="accounts/login.js"></script>
	<script src="accounts/signup.js"></script>
	</main>
<?php include(ROOT_PATH . 'includes/footer.php'); ?>

