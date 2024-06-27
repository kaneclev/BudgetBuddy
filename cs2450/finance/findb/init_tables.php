<?php
require(ROOT_PATH . 'includes/connect-DB.php');
function createUsersTable($pdo) {
    $query = "
    CREATE TABLE IF NOT EXISTS users (
        user_id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) DEFAULT NULL,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
   
	 );";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    } catch (PDOException $e) {
		error_log($e);
	}
}

function createExpenseCategoriesTable($pdo) {
    $query = "
    CREATE TABLE IF NOT EXISTS expense_categories (
        category_id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT,
        category_name VARCHAR(100) NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
    );";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    } catch (PDOException $e) {
		error_log($e);
	}
}

function createExpensesTable($pdo) {
    $query = "
    CREATE TABLE IF NOT EXISTS expenses (
        expense_id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT,
        category_id INT,
        expense_name VARCHAR(100) NOT NULL,
        monthly_expenditure DECIMAL(10, 2) NOT NULL,
        description TEXT,
        FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES expense_categories(category_id) ON DELETE CASCADE
    );";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    } catch (\PDOException $e) {
		error_log($e);
	}
}

function createIncomeStreamsTable($pdo) {
    $query = "
    CREATE TABLE IF NOT EXISTS income_streams (
        income_id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT,
        income_name VARCHAR(100) NOT NULL,
        category VARCHAR(50),
        monthly_income DECIMAL(10, 2) NOT NULL,
        description TEXT,
        FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
    );";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    } catch (\PDOException $e) {
		error_log($e);
	}
}
?>

<?php

// Call the functions to create tables
createUsersTable($pdo);
createExpenseCategoriesTable($pdo);
createExpensesTable($pdo);
createIncomeStreamsTable($pdo);
?>
