<?php
include('../includes/connect-DB.php');
session_start();
header('Content-Type: application/json');

$response = [
    'success' => false,
    'errors' => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username_signup'], $_POST['password_signup'], $_POST['confirm_password_signup'])) {
        $signup_username = trim($_POST['username_signup']);
        $signup_password = trim($_POST['password_signup']);
        $confirm_password = trim($_POST['confirm_password_signup']);

        if (empty($signup_username) || !preg_match('/^[a-zA-Z0-9]+$/', $signup_username)) {
            $response['errors'][] = 'The username cannot contain any special characters.';
        }

        if (strlen($signup_password) < 6) {
            $response['errors'][] = 'The password must be at least 6 characters long.';
        }

        if ($signup_password !== $confirm_password) {
            $response['errors'][] = 'The passwords do not match.';
        }

        if (empty($response['errors'])) {
            $password_hash = password_hash($signup_password, PASSWORD_BCRYPT);

            try {
                $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username');
                $stmt->execute([':username' => $signup_username]);
                if ($stmt->rowCount() > 0) {
                    $response['errors'][] = 'Username already taken.';
                } else {
                    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
                    $stmt->execute([
                        ':username' => $signup_username,
                        ':password' => $password_hash,
                    ]);
                    $response['success'] = true;
                }
            } catch (PDOException $e) {
                $response['errors'][] = $e->getMessage();
            } catch (Exception $e) {
				$response['errors'][] = 'An unexpected error occurred. Please try again later.';
				error_log($e->getMessage());
			}
        }
    }
}

echo json_encode($response);
exit();
?>

