<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/cs2450/config.php');

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: index.php');
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // skeleton logic for now, going to implement a way to retrieve stuff from the database after. 
    if ($username == 'user' && $password == 'pass') {
        $_SESSION['logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

// Handle AJAX form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // need to implement the logic to retrieve the pass and stuff from the form and then check against that
    // for now just leaving the username as user and pass. 
    if ($username == 'user' && $password == 'pass') {
        $_SESSION['logged_in'] = true;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    }
    exit;
}
?>
<?php include(ROOT_PATH . 'includes/top.php'); ?> 
    <main>
        <div class="login-container">
            <h2>Log In</h2>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form id="loginForm" action="login.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Log In</button>
            </form>
            <p class="signup-link">Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </main>
    <?php include('includes/footer.php'); ?>
    <script src="js/login.js"></script>
</body>
</html>

