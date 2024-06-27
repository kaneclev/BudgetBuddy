<?php
include("../includes/top.php");
require("../includes/form.php");
?>

<main>
	<div class="expense-container">
		<h1>Manage Your Expenses</h1>
		<br>
		<div id="add-expense-form">
			<h2>Add an expense to one of your expense categories in your budget</h2>
			<br>
            <?php
                renderFormStart('expense-form', 'finance/budget-handler.php', 'POST');
                echo '<input type="hidden" name="action" value="add_expense">';
                renderTextInputField('text', 'expense-name', 'expense_name', 'Expense Name:', true);
                renderTextInputField('number', 'monthly-cost', 'monthly_cost', 'Monthly Cost:', true, 'decimal');
                renderFormEnd('Add Expense', 'add-expense-btn');
            ?>
            <div class="error"></div>

        <div id="delete-expense-form">
            <?php
                renderFormStart('delete-expense-form', 'finance/budget-handler.php', 'POST');
                echo '<input type="hidden" name="action" value="delete_expense">';
            ?>

            <label for="delete-expense">Delete Expense:</label>
            <select id="delete-expense" name="expense_id">
                <!-- Options will be populated dynamically -->
            </select>
            <div class="error"></div>
            <?php
                renderFormEnd('Delete', 'delete-expense-btn');
            ?>
        </div>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="finance/expense.js">
</main>


<?php
include("../includes/footer.php");
?>
