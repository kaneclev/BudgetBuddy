<?php
require($_SERVER['DOCUMENT_ROOT'] . '/cs2450/config.php');
include(ROOT_PATH . 'includes/connect-DB.php');
session_start();

$response = ['status' => 'error', 'message' => 'Invalid request'];
$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action === 'add_income') {
            $income_name = $_POST['income_name'] ?? '';
            $monthly_income = $_POST['monthly_income'] ?? '';
            $description = $_POST['description'] ?? null;
			$category_id = $_POST['category_id'] ?? '';

            if ($income_name && $monthly_income && $category_id) {
                $stmt = $pdo->prepare("INSERT INTO incomes (user_id, category_id, income_name, monthly_income, description) VALUES (:user_id, :category_id, :income_name, :monthly_income, :description)");
                if ($stmt->execute(['user_id' => $user_id, 'category_id' => $category_id, 'income_name' => $income_name, 'monthly_income' => $monthly_income, 'description' => $description])) {
                    $response = ['status' => 'success'];
                } else {
                    $response['message'] = 'Failed to add income.';
                }
            } else {
                $response['message'] = 'All fields are required.';
            }
        } elseif ($action === 'delete_income') {
            $income_id = $_POST['income_id'] ?? '';

            if ($income_id) {
                $stmt = $pdo->prepare("DELETE FROM incomes WHERE income_id = :income_id AND user_id = :user_id");
                if ($stmt->execute(['income_id' => $income_id, 'user_id' => $user_id])) {
                    $response = ['status' => 'success'];
                } else {
                    $response['message'] = 'Failed to delete income.';
                }
            } else {
                $response['message'] = 'Income ID is required.';
            }
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $action = $_GET['action'] ?? '';

        if ($action === 'get_income_categories') {
            $stmt = $pdo->prepare("SELECT category_id, category_name FROM income_categories WHERE user_id = :user_id");
            $stmt->execute(['user_id' => $user_id]);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = ['status' => 'success', 'categories' => $categories];
        } elseif ($action === 'get_income_by_category') {
            $category_id = $_GET['category_id'] ?? '';

            if ($category_id) {
                $stmt = $pdo->prepare("SELECT income_id, income_name, monthly_income FROM incomes WHERE user_id = :user_id AND category_id = :category_id");
                $stmt->execute(['user_id' => $user_id, 'category_id' => $category_id]);
                $incomes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = ['status' => 'success', 'incomes' => $incomes];
            } else {
                $response['message'] = 'Category ID is required.';
            }
        }
    }
}

echo json_encode($response);
?>

