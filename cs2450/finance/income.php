<?php
include("../includes/top.php");
require("../includes/form.php");
?>

<main>
    <div class="income-container">
        <h1>Manage Your Income</h1>
        <br>
        <div id="add-income-form">
            <h2>What kind of income are you expecting?</h2>
            <h3>Add an income source to any of the income categories you defined in your budget to get started.</h3>
            <br>
            <label for="income-category">Income Category:</label>
            <select id="income-category" name="category_id">
                <!-- Options will be populated dynamically -->
            </select>
            <br>
            <?php
                renderFormStart('income-form', 'finance/income-handler.php', 'POST');
                echo '<input type="hidden" name="action" value="add_income">';
                renderTextInputField('text', 'income-name', 'income_name', 'Income Name:', true);
                renderTextInputField('number', 'monthly-income', 'monthly_income', 'Monthly Income:', true, 'decimal');
                renderFormEnd('Add Income', 'add-income-btn');
            ?>
            <div class="error"></div>
        </div>

        <div id="delete-income-form">
            <?php
                renderFormStart('delete-income-form', 'finance/income-handler.php', 'POST');
                echo '<input type="hidden" name="action" value="delete_income">';
            ?>
            <label for="delete-income">Remove an Income Source:</label>
            <select id="delete-income" name="income_id">
                <!-- Options will be populated dynamically -->
            </select>
            <div class="error"></div>
            <?php
                renderFormEnd('Delete', 'delete-income-btn');
            ?>
        </div>

        <!-- New Container for Income by Category -->
        <div id="income-by-category">
            <h2>Income in Selected Category</h2>
            <ul id="income-list">
                <!-- List items will be populated dynamically -->
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="finance/income.js"></script>
</main>

<?php
include("../includes/footer.php");
?>

