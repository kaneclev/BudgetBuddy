<?php
require($_SERVER['DOCUMENT_ROOT'] . '/cs2450/config.php');
include(ROOT_PATH . 'includes/connect-DB.php');
$response = ['status' => 'error', 'message' => 'Invalid request'];
session_start();
$user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add_expense') {
        $expense_name = $_POST['expense_name'];
        $expense_category = $_POST['expense_category'];
        $monthly_cost = $_POST['monthly_cost'];

        $stmt = $pdo->prepare("INSERT INTO expenses (user_id, category_id, expense_name, monthly_expenditure) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $expense_category, $expense_name, $monthly_cost]);
        $response = ['status' => 'success', 'message' => 'Expense added successfully'];
    }

    if ($action === 'delete_expense') {
        $expense_id = $_POST['expense_id'];
        $stmt = $pdo->prepare("DELETE FROM expenses WHERE user_id = ? AND expense_id = ?");
        $stmt->execute([$user_id, $expense_id]);
        $response = ['status' => 'success', 'message' => 'Expense deleted successfully'];
    }

	if ($action === 'add_category') {
        error_log("LOOK AT MY SESSION USER ID: " . $user_id);

		$category_name = $_POST['category_name'];
		error_log("LOOK AT MY CATEGORY NAME: " . $category_name);
        $stmt = $pdo->prepare("INSERT INTO expense_categories (user_id, category_name) VALUES (?, ?)");
        $stmt->execute([$user_id, $category_name]);
        $response = ['status' => 'success', 'message' => 'Category added successfully'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->prepare("SELECT expenses.*, expense_categories.category_name FROM expenses JOIN expense_categories ON expenses.category_id = expense_categories.category_id WHERE expenses.user_id = ?");
    $stmt->execute([$user_id]);
    $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($expenses);
    exit();
}

echo json_encode($response);
?>
