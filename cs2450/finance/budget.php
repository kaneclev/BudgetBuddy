<?php
include("../includes/top.php");
require('../includes/form.php');
$user_id = $_SESSION['user_id'];
?>

<main>
    <div id="budget-container">
        <h1 id="form-title">Define Your Budget</h1>

        <div id="add-expense-category-form">
            <?php
                renderFormStart('add-expense-category-form', 'finance/budget-handler.php', 'POST');
                echo '<input type="hidden" name="action" value="add_expense_category">';
                renderTextInputField('text', 'new-expense-category-name', 'new_expense_category_name', 'Add an expense category:', true);
				renderTextInputField('text', 'description', 'description', 'Description: (Optional)', false);
				renderFormEnd('Add Category', 'add-expense-category-btn');
            ?>
            <div class="error"></div>
        </div>
        <br>
        <div id="expense-category-list">
            <a>Your Expense Categories</a>
            <ul></ul>
        </div>
        <br>
        <div id="add-income-category-form">
            <?php
                renderFormStart('add-income-category-form', 'finance/budget-handler.php', 'POST');
                echo '<input type="hidden" name="action" value="add_income_category">';
                renderTextInputField('text', 'new-income-category-name', 'new_income_category_name', 'Add an income category:', true);
                renderTextInputField('text', 'description', 'description', 'Description: (Optional)', false);
				renderFormEnd('Add Category', 'add-income-category-btn');
            ?>
            <div class="error"></div>
        </div>
        <br>
        <div id="income-category-list">
            <a>Your Income Categories</a>
            <ul></ul>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="finance/budget.js"></script>
    </div>
</main>

<?php
include(ROOT_PATH . "includes/footer.php");
?>

