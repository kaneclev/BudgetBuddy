<?php
require($_SERVER['DOCUMENT_ROOT'] . '/cs2450/config.php');
include(ROOT_PATH . 'includes/connect-DB.php');
$response = ['status' => 'error', 'message' => 'Invalid request'];
session_start();
$user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add_expense_category') {
        $category_name = $_POST['category_name'];
        $description = $_POST['description'] ?? null;
        $stmt = $pdo->prepare("INSERT INTO expense_categories (user_id, category_name, description) VALUES (?, ?, ?)");
        if ($stmt->execute([$user_id, $category_name, $description])) {
            $response = [
                'status' => 'success',
                'category_id' => $pdo->lastInsertId() // Get the last inserted ID
            ];
        } else {
            $response['message'] = 'Failed to add expense category.';
        }
    } elseif ($action === 'add_income_category') {
        $category_name = $_POST['category_name'];
        $description = $_POST['description'] ?? null;
        $stmt = $pdo->prepare("INSERT INTO income_categories (user_id, category_name, description) VALUES (?, ?, ?)");
        if ($stmt->execute([$user_id, $category_name, $description])) {
            $response = [
                'status' => 'success',
                'category_id' => $pdo->lastInsertId() // Get the last inserted ID
            ];
        } else {
            $response['message'] = 'Failed to add income category.';
        }
    } elseif ($action === 'delete_category') {
        $category_id = $_POST['category_id'];
        $category_type = $_POST['category_type'];
        $table = '';

        if ($category_type === 'expense') {
            $table = 'expense_categories';
        } elseif ($category_type === 'income') {
            $table = 'income_categories';
        }

        if (!empty($table)) {
            $stmt = $pdo->prepare("DELETE FROM $table WHERE category_id = ? AND user_id = ?");
            if ($stmt->execute([$category_id, $user_id])) {
                $response = ['status' => 'success'];
            } else {
                $response['message'] = 'Failed to delete category.';
            }
        } else {
            $response['message'] = 'Invalid category type.';
        }
    } elseif ($action === 'get_expenses') {
		$category_id = $_POST['category_id'];
        $stmt = $pdo->prepare("SELECT expense_name, monthly_expenditure FROM expenses WHERE category_id = ? AND user_id = ?");
        $stmt->execute([$category_id, $user_id]);
        $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response = [
            'status' => 'success',
            'expenses' => $expenses
        ];       
	
	} elseif ($action === 'get_description_by_category_id') {
		$category_id = $_POST['category_id'];
		$category_type = $_POST['category_type'];
		
		$stmt = $pdo->prepare("SELECT description FROM $category_type WHERE category_id = :category_id");
		if ($stmt->execute(['category_id' => $category_id])) {
			$description = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$response = [
					'status' => 'success', 
					'description' => $description
			];
		} else {
			$response['message'] = "Couldnt retrieve description for $category_type";
		}
		

	}

	 elseif ($action === 'get_incomes') {
            $category_id = $_POST['category_id'] ?? '';

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




if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	/* These queries will grab the expense and income categories from their respective tables by the user_id */
	$expenseStmt = $pdo->prepare("SELECT category_id, category_name, description FROM expense_categories WHERE user_id = ?");
    $expenseStmt->execute([$user_id]);
    $expense_categories = $expenseStmt->fetchAll(PDO::FETCH_ASSOC);

    $incomeStmt = $pdo->prepare("SELECT category_id, category_name, description FROM income_categories WHERE user_id = ?");
    $incomeStmt->execute([$user_id]);
    $income_categories = $incomeStmt->fetchAll(PDO::FETCH_ASSOC);

    $response = [
        'expense_categories' => $expense_categories,
        'income_categories' => $income_categories
    ];

    echo json_encode($response);
	exit();
}

echo json_encode($response);
?>

