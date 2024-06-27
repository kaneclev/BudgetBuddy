<?php
/* Include top.php */
include("../includes/top.php");
?>

<main>
	 <div id="budget-container">
        <h1 id="form-title">Define Your Budget</h1>
        
        <?php
			require('../includes/form.php');
            renderFormStart('expense-form', 'finance/budget-handler.php', 'POST');
            renderTextInputField('text', 'expense-name', 'expense_name', 'Expense Name:', true);
            renderTextInputField('number', 'monthly-cost', 'monthly_cost', 'Monthly Cost:', true);
        ?>
        <label for="expense-category">Category:</label>
        <select id="expense-category" name="expense_category">
            <!-- Options will be populated dynamically -->
        </select>
        <?php
            renderFormEnd('Add Expense', 'add-expense-btn');
        ?>
        
        <?php
            renderFormStart('delete-expense-form', 'finance/budget-handler.php', 'POST');
        ?>
        <label for="delete-expense">Delete Expense:</label>
        <select id="delete-expense" name="expense_id">
            <!-- Options will be populated dynamically -->
        </select>
        <?php
            renderFormEnd('Delete', 'delete-expense-btn');
        ?>
    </div>

    <div id="expenses-list">
        <!-- List of expenses will be populated dynamically -->
    </div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="finance/budget.js"></script>
	
</main>


<?php
include(ROOT_PATH . "includes/footer.php");
?>    
