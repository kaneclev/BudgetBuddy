<?php
require('includes/connect-DB.php');
session_start();

$response = ['status' => 'error', 'message' => 'Invalid request'];
$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    $expenseQuery = "
    SELECT expense_categories.category_name, SUM(expenses.monthly_expenditure) as total_expenditure
    FROM expenses
    JOIN expense_categories ON expenses.category_id = expense_categories.category_id
    WHERE expenses.user_id = :user_id
    GROUP BY expense_categories.category_name";

    $incomeQuery = "
    SELECT income_categories.category_name, SUM(incomes.monthly_income) as total_income
    FROM incomes
    JOIN income_categories ON incomes.category_id = income_categories.category_id
    WHERE incomes.user_id = :user_id
    GROUP BY income_categories.category_name";

    try {
        // Fetch expenses
        $stmt = $pdo->prepare($expenseQuery);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $expenseResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch incomes
        $stmt = $pdo->prepare($incomeQuery);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $incomeResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response = [
            'status' => 'success',
            'expenses' => $expenseResults,
            'incomes' => $incomeResults
        ];
    } catch (PDOException $e) {
        error_log($e);
        $response['message'] = 'Failed to fetch data.';
    }
}

echo json_encode($response);
?>

