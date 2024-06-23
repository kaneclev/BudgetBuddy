<?php				
include('../includes/connect-DB.php');
session_start();
header('Content-Type: application/json');

$response = [
    'success' => false,
    'errors' => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        try {
            $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = :username');
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['logged_in'] = true;
                $response['success'] = true;
            } else {
                $response['errors'][] = 'Invalid username or password.';
            }
        } catch (PDOException $e) {
            $response['errors'][] = 'There was a problem logging in. Try again later.';
            error_log($e->getMessage());
        } catch (Exception $e) {
			$response['errors'][] = 'An unexpected error occurred. Please try again later.';
			error_log($e->getMessage());
		}	
		
    }
}

echo json_encode($response);
exit();
?>	
