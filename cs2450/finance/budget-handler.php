<?php
require($_SERVER['DOCUMENT_ROOT'] . '/cs2450/config.php');
include(ROOT_PATH . 'includes/connect-DB.php');
$response = ['status' => 'error', 'message' => 'Invalid request'];
session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add_budget') {
        $budget_name = $_POST['budget_name'];
        $expense_category = $_POST['expense_category'];
        $new_category = $_POST['new_category'];
        $monthly_expenditure = $_POST['monthly_expenditure'];
        
        if (!empty($new_category)) {
            // Insert new category
            $stmt = $pdo->prepare("INSERT INTO expense_categories (user_id, category_name) VALUES (?, ?)");
            $stmt->execute([$user_id, $new_category]);
            $expense_category = $pdo->lastInsertId();
        }

        // Check if budget already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM expenses WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $budgetExists = $stmt->fetchColumn() > 0;

        if ($budgetExists) {
            // Update existing budget
            $stmt = $pdo->prepare("UPDATE expenses SET category_id = ?, expense_name = ?, monthly_expenditure = ? WHERE user_id = ?");
            $stmt->execute([$expense_category, $budget_name, $monthly_expenditure, $user_id]);
        } else {
            // Insert new budget
            $stmt = $pdo->prepare("INSERT INTO expenses (user_id, category_id, expense_name, monthly_expenditure) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $expense_category, $budget_name, $monthly_expenditure]);
        }
    }

    if ($action === 'delete_budget') {
        $category_id = $_POST['category_id'];
        $stmt = $pdo->prepare("DELETE FROM expenses WHERE user_id = ? AND category_id = ?");
        $stmt->execute([$user_id, $category_id]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->prepare("SELECT expenses.*, expense_categories.category_name FROM expenses JOIN expense_categories ON expenses.category_id = expense_categories.category_id WHERE expenses.user_id = ?");
    $stmt->execute([$user_id]);
    $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($expenses);
}
?>
