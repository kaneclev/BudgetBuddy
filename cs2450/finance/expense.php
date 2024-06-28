<?php
include("../includes/top.php");
require("../includes/form.php");
?>

<main>
    <div class="expense-container">
        <h1>Manage Your Expenses</h1>
        <br>
        <div id="add-expense-form">
            <h2>What kind of expenses are you expecting?</h2>
            <h3>Add an expenditure to any of the expense categories you defined in your budget to get started.</h3>
            <br>
            <div class="notice"></div>
			<label for="expense-category">Expense Category:</label> 
			<select id="expense-category" name="category_id">
                <!-- Options will be populated dynamically -->
            </select>
            <br>
            <?php
                renderFormStart('expense-form', 'finance/expense-handler.php', 'POST');
                echo '<input type="hidden" name="action" value="add_expense">';
                renderTextInputField('text', 'expense-name', 'expense_name', 'Expense Name:', true);
                renderTextInputField('number', 'monthly-cost', 'monthly_cost', 'Monthly Cost:', true, 'decimal');
                renderTextInputField('text', 'description', 'description', 'Description: (Optional)', false);
				renderFormEnd('Add Expense', 'add-expense-btn');
				
			?>
			


			<div class="error"></div>
        </div>

        <div id="delete-expense-form">
            <?php
                renderFormStart('delete-expense-form', 'finance/expense-handler.php', 'POST');
                echo '<input type="hidden" name="action" value="delete_expense">';
            ?>
            <label for="delete-expense">Remove an Expense:</label>
            <select id="delete-expense" name="expense_id">
                <!-- Options will be populated dynamically -->
            </select>
            <div class="error"></div>
            <?php
                renderFormEnd('Delete', 'delete-expense-btn');
            ?>
        </div>

        <!-- New Container for Expenses by Category -->
        <div id="expenses-by-category">
            <h2>Expenses in Selected Category</h2>
            <ul id="expense-list">
                <!-- List items will be populated dynamically -->
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="finance/expense.js"></script>
</main>

<?php
include("../includes/footer.php");
?>

