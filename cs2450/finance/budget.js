

$(document).ready(function() {

    let errorContainer = $('.error');

    function addError(message) {
        errorContainer.append('<div class="error">' + message + '</div>');
    }

    function clearError(message) {
        errorContainer.find('.error').each(function() {
            if ($(this).text() === message) {
                $(this).remove();
            }
        });
    }

    function clearAllErrors() {
        errorContainer.empty();
    }

    $('#add-budget-btn').on('click', function() {
        clearAllErrors();
        
        const budgetName = $('#budget-name').val();
        const expenseCategory = $('#expense-category').val();
        const newCategory = $('#new-category').val();
        const monthlyExpenditure = $('#monthly-expenditure').val();

        // Client-side validation
        if (budgetName === '') {
            addError('Budget name is required.');
        }
        if (monthlyExpenditure === '' || monthlyExpenditure <= 0) {
            addError('Monthly expenditure must be a positive number.');
        }

        if ($('.error').length === 0) {
            const formData = {
                action: 'add_budget',
                budget_name: budgetName,
                expense_category: expenseCategory,
                new_category: newCategory,
                monthly_expenditure: monthlyExpenditure
            };

            $.ajax({
                url: 'finance/budget-handler.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        loadBudgetData();
                    } else {
                        addError(response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    addError('An error occurred while processing your request. Please try again.');
                }
            });
        }
    });

    $('#delete-budget-btn').on('click', function() {
        clearAllErrors();

        const categoryId = $('#delete-category').val();

        if (categoryId === null) {
            addError('Please select a category to delete.');
            return;
        }

        const formData = {
            action: 'delete_budget',
            category_id: categoryId
        };

        $.ajax({
            url: 'finance/budget-handler.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    loadBudgetData();
                } else {
                    addError(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                addError('An error occurred while processing your request. Please try again.');
            }
        });
    });

    function loadBudgetData() {
        $.ajax({
            url: 'finance/budget-handler.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const expenseCategory = $('#expense-category');
                const deleteCategory = $('#delete-category');

                expenseCategory.empty();
                deleteCategory.empty();

                if (data.length > 0) {
                    $('#form-title').text('Edit Budget');
                    $('#add-budget-btn').text('Update Budget');

                    const expense = data[0];
                    $('#budget-name').val(expense.expense_name);
                    $('#monthly-expenditure').val(expense.monthly_expenditure);

                    data.forEach(function(expense) {
                        expenseCategory.append(new Option(expense.category_name, expense.category_id));
                        deleteCategory.append(new Option(expense.category_name, expense.category_id));
                    });

                    expenseCategory.val(expense.category_id);
                } else {
                    $('#form-title').text('Create A Budget');
                    $('#add-budget-btn').text('Add Budget');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                addError('An error occurred while loading the budget data. Please try again.');
            }
        });
    }

    loadBudgetData();
});

