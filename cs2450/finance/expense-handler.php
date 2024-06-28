<?php
require($_SERVER['DOCUMENT_ROOT'] . '/cs2450/config.php');
include(ROOT_PATH . 'includes/connect-DB.php');
session_start();

$response = ['status' => 'error', 'message' => 'Invalid request'];
$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action === 'add_expense') {
            $expense_name = $_POST['expense_name'] ?? '';
            $monthly_cost = $_POST['monthly_cost'] ?? '';
			$description = $_POST['description'] ?? '';
            $category_id = $_POST['category_id'] ?? '';

            if ($expense_name && $monthly_cost && $category_id) {
                $stmt = $pdo->prepare("INSERT INTO expenses (user_id, category_id, expense_name, monthly_expenditure, description) VALUES (:user_id, :category_id, :expense_name, :monthly_cost, :description)");
                if ($stmt->execute(['user_id' => $user_id, 'category_id' => $category_id, 'expense_name' => $expense_name, 'monthly_cost' => $monthly_cost, 'description' => $description])) {
                    $response = ['status' => 'success'];
                } else {
                    $response['message'] = 'Failed to add expense.';
                }
            } else {
                $response['message'] = 'Category, expense name, and monthly cost are required.';
            }
        } elseif ($action === 'delete_expense') {
            $expense_id = $_POST['expense_id'] ?? '';

            if ($expense_id) {
                $stmt = $pdo->prepare("DELETE FROM expenses WHERE expense_id = :expense_id AND user_id = :user_id");
                if ($stmt->execute(['expense_id' => $expense_id, 'user_id' => $user_id])) {
                    $response = ['status' => 'success'];
                } else {
                    $response['message'] = 'Failed to delete expense.';
                }
            } else {
                $response['message'] = 'Expense ID is required.';
            }
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $action = $_GET['action'] ?? '';

        if ($action === 'get_expense_categories') {
            $stmt = $pdo->prepare("SELECT category_id, category_name, description FROM expense_categories WHERE user_id = :user_id");
            $stmt->execute(['user_id' => $user_id]);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = ['status' => 'success', 'categories' => $categories];
        } elseif ($action === 'get_expenses') {
            $stmt = $pdo->prepare("SELECT expense_id, expense_name, monthly_expenditure, description FROM expenses WHERE user_id = :user_id");
            $stmt->execute(['user_id' => $user_id]);
            $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = ['status' => 'success', 'expenses' => $expenses];
        } elseif ($action === 'get_expenses_by_category') {
            $category_id = $_GET['category_id'] ?? '';

            if ($category_id) {
                $stmt = $pdo->prepare("SELECT expense_id, expense_name, monthly_expenditure FROM expenses WHERE user_id = :user_id AND category_id = :category_id");
                $stmt->execute(['user_id' => $user_id, 'category_id' => $category_id]);
                $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = ['status' => 'success', 'expenses' => $expenses];
            } else {
                $response['message'] = 'Category ID is required.';
            }
        }
    }
}

echo json_encode($response);
?>
