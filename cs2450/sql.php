<?php 
include('includes/top.php');
?>

	 <h1>SQL Queries and Descriptions</h1>
		<br>
        <!-- Signup Handler -->
        <div class="query-section">
            <h2>signup-handler.php</h2>

            <h3>INSERT INTO users</h3>
            <pre class="sql-query">
INSERT INTO users (username, password) VALUES (:username, :password);
            </pre>
            <p class="description">
                Inserts a new user into the users table with a username and password.
            </p>

            <h3>SELECT user_id FROM users</h3>
            <pre class="sql-query">
SELECT user_id FROM users WHERE username = :username;
            </pre>
            <p class="description">
                Retrieves the user_id of a user with a specific username.
            </p>
        </div>
		<br>
        <!-- Login Handler -->
        <div class="query-section">
            <h2>login-handler.php</h2>

            <h3>SELECT user_id, username, password FROM users</h3>
            <pre class="sql-query">
SELECT user_id, username, password FROM users WHERE username = :username;
            </pre>
            <p class="description">
                Retrieves the user_id, username, and password of a user with a specific username for login verification.
            </p>
        </div>
		<br>
        <!-- Budget Handler -->
        <div class="query-section">
            <h2>budget-handler.php</h2>

            <h3>INSERT INTO expense_categories</h3>
            <pre class="sql-query">
INSERT INTO expense_categories (user_id, category_name, description) VALUES (?, ?, ?);
            </pre>
            <p class="description">
                Inserts a new expense category for a user with a name and description.
            </p>

            <h3>INSERT INTO income_categories</h3>
            <pre class="sql-query">
INSERT INTO income_categories (user_id, category_name, description) VALUES (?, ?, ?);
            </pre>
            <p class="description">
                Inserts a new income category for a user with a name and description.
            </p>

            <h3>DELETE FROM $table WHERE category_id = ? AND user_id = ?</h3>
            <pre class="sql-query">
DELETE FROM $table WHERE category_id = ? AND user_id = ?;
            </pre>
            <p class="description">
                Deletes a category (either expense or income) for a user based on category_id and user_id.
            </p>

            <h3>SELECT expense_name, monthly_expenditure FROM expenses WHERE category_id = ? AND user_id = ?</h3>
            <pre class="sql-query">
SELECT expense_name, monthly_expenditure FROM expenses WHERE category_id = ? AND user_id = ?;
            </pre>
            <p class="description">
                Retrieves expense names and monthly expenditures for a specific category and user.
            </p>

            <h3>SELECT description FROM $category_type WHERE category_id = :category_id</h3>
            <pre class="sql-query">
SELECT description FROM $category_type WHERE category_id = :category_id;
            </pre>
            <p class="description">
                Retrieves the description for a specific category type (expense or income) based on category_id.
            </p>

            <h3>SELECT income_id, income_name, monthly_income FROM incomes WHERE user_id = :user_id AND category_id = :category_id</h3>
            <pre class="sql-query">
SELECT income_id, income_name, monthly_income FROM incomes WHERE user_id = :user_id AND category_id = :category_id;
            </pre>
            <p class="description">
                Retrieves income details for a user based on user_id and category_id.
            </p>

            <h3>SELECT category_id, category_name, description FROM expense_categories WHERE user_id = ?</h3>
            <pre class="sql-query">
SELECT category_id, category_name, description FROM expense_categories WHERE user_id = ?;
            </pre>
            <p class="description">
                Retrieves all expense categories for a specific user.
            </p>

            <h3>SELECT category_id, category_name, description FROM income_categories WHERE user_id = ?</h3>
            <pre class="sql-query">
SELECT category_id, category_name, description FROM income_categories WHERE user_id = ?;
            </pre>
            <p class="description">
                Retrieves all income categories for a specific user.
            </p>
        </div>
		<br>
        <!-- Expense Handler -->
        <div class="query-section">
            <h2>expense-handler.php</h2>

            <h3>INSERT INTO expenses</h3>
            <pre class="sql-query">
INSERT INTO expenses (user_id, category_id, expense_name, monthly_expenditure, description) VALUES (:user_id, :category_id, :expense_name, :monthly_cost, :description);
            </pre>
            <p class="description">
                Inserts a new expense for a user with specified details.
            </p>

            <h3>DELETE FROM expenses WHERE expense_id = :expense_id AND user_id = :user_id</h3>
            <pre class="sql-query">
DELETE FROM expenses WHERE expense_id = :expense_id AND user_id = :user_id;
            </pre>
            <p class="description">
                Deletes a specific expense for a user based on expense_id and user_id.
            </p>

            <h3>SELECT category_id, category_name, description FROM expense_categories WHERE user_id = :user_id</h3>
            <pre class="sql-query">
SELECT category_id, category_name, description FROM expense_categories WHERE user_id = :user_id;
            </pre>
            <p class="description">
                Retrieves all expense categories for a user based on user_id.
            </p>

            <h3>SELECT expense_id, expense_name, monthly_expenditure, description FROM expenses WHERE user_id = :user_id</h3>
            <pre class="sql-query">
SELECT expense_id, expense_name, monthly_expenditure, description FROM expenses WHERE user_id = :user_id;
            </pre>
            <p class="description">
                Retrieves all expenses for a user based on user_id.
            </p>

            <h3>SELECT expense_id, expense_name, monthly_expenditure FROM expenses WHERE user_id = :user_id AND category_id = :category_id</h3>
            <pre class="sql-query">
SELECT expense_id, expense_name, monthly_expenditure FROM expenses WHERE user_id = :user_id AND category_id = :category_id;
            </pre>
            <p class="description">
                Retrieves expenses for a user based on user_id and category_id.
            </p>
        </div>
		<br>
        <!-- Income Handler -->
        <div class="query-section">
            <h2>income-handler.php</h2>

            <h3>INSERT INTO incomes</h3>
            <pre class="sql-query">
INSERT INTO incomes (user_id, category_id, income_name, monthly_income, description) VALUES (:user_id, :category_id, :income_name, :monthly_income, :description);
            </pre>
            <p class="description">
                Inserts a new income record for a user with specified details.
            </p>

            <h3>DELETE FROM incomes WHERE income_id = :income_id AND user_id = :user_id</h3>
            <pre class="sql-query">
DELETE FROM incomes WHERE income_id = :income_id AND user_id = :user_id;
            </pre>
            <p class="description">
                Deletes a specific income record for a user based on income_id and user_id.
            </p>

            <h3>SELECT category_id, category_name FROM income_categories WHERE user_id = :user_id</h3>
            <pre class="sql-query">
SELECT category_id, category_name FROM income_categories WHERE user_id = :user_id;
            </pre>
            <p class="description">
                Retrieves all income categories for a user based on user_id.
            </p>

            <h3>SELECT income_id, income_name, monthly_income FROM incomes WHERE user_id = :user_id</h3>
            <pre class="sql-query">
SELECT income_id, income_name, monthly_income FROM incomes WHERE user_id = :user_id;
            </pre>
            <p class="description">
                Retrieves all income records for a user based on user_id.
            </p>
        </div>

    </section>
</main>
<?php
include('includes/footer.php');
?>
