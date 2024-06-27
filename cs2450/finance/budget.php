<?php
/* Include top.php */
include("../includes/top.php");
?>

<main>
	<div id="budget-container">
        <h1 id="form-title">Create A Budget</h1>
        
        <?php
			include(ROOT_PATH . 'includes/form.php');
            renderFormStart('budget-form', 'budget-handler.php', 'POST');
            renderTextInputField('text', 'budget-name', 'budget_name', 'Budget Name:', true);
        ?>

        <label for="expense-category">Expense Category:</label>
        <select id="expense-category" name="expense_category">
            <!-- Options will be populated dynamically -->
        </select>
        <input type="text" id="new-category" name="new_category" placeholder="Or add new category">

        <?php
            renderTextInputField('number', 'monthly-expenditure', 'monthly_expenditure', 'Monthly Expenditure:', true);
            renderFormEnd('Add Budget', 'add-budget-btn');
        ?>
        
        <?php
            renderFormStart('delete-budget-form', 'budget-handler.php', 'POST');
        ?>
        <label for="delete-category">Delete Budget:</label>
        <select id="delete-category" name="category_id">
            <!-- Options will be populated dynamically -->
        </select>
        <?php
            renderFormEnd('Delete', 'delete-budget-btn');
        ?>
    </div>        
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="budget.js"></script>
	
</main>


<?php
include(ROOT_PATH . "includes/footer.php");
?>    
