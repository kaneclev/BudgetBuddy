<?php
include($_SERVER['DOCUMENT_ROOT'] . '/cs2450/config.php');


include(ROOT_PATH . 'includes/top.php');
session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username_signup']);
    $password = trim($_POST['password_signup']);
    $confirm_password = trim($_POST['confirm_password_signup']);

    // backup php validation if js isnt active in the browser
	
    if (empty($username) || !preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $errors[] = 'The username cannot contain any special characters.';
    }


    if (strlen($password) < 6) {
        $errors[] = 'The password must be at least 6 characters long.';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'The passwords do not match.';
    }
    if (empty($errors)) {
        // use password_hash builtin for hashing the password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        try {
            // Connect to the database

            // Check if username or email already exists
            $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username');
            $stmt->execute([':username' => $username]);
            if ($stmt->rowCount() > 0) {
                $errors[] = 'Username already taken.';
            } else {
                // Insert the new user into the database
                print('Inserting ' . $password_hash . ' into database...');
				$stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
                $stmt->execute([
                    ':username' => $username,
                    ':password' => $password_hash,
                ]);

                // Redirect to a success page
                header('Location: index.php');
                exit();
            }
        } catch (PDOException $e) {
            $errors[] = $e->getMessage();
        }
    }

    if (!empty($errors)) {
        $_SESSION['signup_error'] = $errors;
        error_log('LOOK HERE LOOK LISTEN : ' . $errors);
		header('Location: login.php');
        exit();
    }
} else if (isset($_POST['username'], $_POST['password'])) {
	try {
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$stmt = $pdo->prepare('SELECT id, password FROM users WHERE username = :username');
		$stmt->execute([':username' => $username]);
		$user = $stmt->fetch();

		// now we check if the username is present in the database, and if the given password matches.
		if ($user && password_verify($password, $user['password'])) {
			// then the $user record is present in the db and the password matches!
			// set the session id for when we go to pull records from other tables later on...
			$_SESSION['user_id'] = $user['id'];
			header('Location: dashboard.php');	

		} else {
			$errors[] = 'Invalid username or password.';
		}	
	} catch (PDOException $e) {
		$errors[] = 'There was a problem logging in. Try again later.';
		error_log($e->getMessage());
	}
	if (!empty($errors)) { // Then there was at least one issue logging in.
		// Assign login error to the k-v pair in $_SESSION  
		$_SESSION['login_error'] = $errors;
	}
}
?>


    <main>

	<?php
    session_start();
    if (isset($_SESSION['signup_error'])) {
        echo '<div class="error-container">';
        foreach ($_SESSION['signup_error'] as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo '</div>';
        unset($_SESSION['signup_error']); // Clear errors after displaying
    }
    ?>

	
        <div class="login-container">
            <h2>Log In</h2>
            <?php if (isset($login_error)): ?>
                <p class="error"><?php echo $login_error; ?></p>
            <?php endif; ?>       
			<?php
				include(ROOT_PATH . 'includes/form.php');
				renderFormStart('loginForm', 'login.php', 'POST'); // use form.php to start the form
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
				renderFormStart('signupForm', 'login.php', 'POST');
				renderTextInputField('text', 'username_signup', 'username_signup', 'Username:');
				renderTextInputField('password', 'password_signup', 'password_signup', 'Password:');
				renderTextInputField('text', 'confirm_password_signup', 'confirm_password_signup', 'Confirm Password:');
				renderFormEnd('Sign Up');	
			?>
		</div>
    <script src="js/login.js"></script>
	<script src="js/signup.js"></script>
    </main>
<?php include(ROOT_PATH . 'includes/footer.php'); ?>

