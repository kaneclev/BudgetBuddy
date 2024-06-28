$(document).ready(function() {
    function addError(errorContainer, message) {
        errorContainer.append('<div class="error">' + message + '</div>');
    }

    function clearAllErrors(errorContainer) {
        errorContainer.empty();
    }

    function populateSelect(selectElement, items, valueKey, textKey) {
        selectElement.empty();
        items.forEach(function(item) {
            const optionHtml = `<option value="${item[valueKey]}">${item[textKey]}</option>`;
            selectElement.append(optionHtml);
        });
    }
	loadCategories();
    function loadCategories() {
		console.log('Trying to load the categories...');
        $.ajax({
            url: 'finance/expense-handler.php',
            type: 'GET',
            data: { action: 'get_expense_categories' },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    populateSelect($('#expense-category'), response.categories, 'category_id', 'category_name');
                    // Load expenses for the first category by default
					if (response.categories.length > 0) {
						const firstCategoryId = response.categories[0].category_id;
					} else {
						const firstCategoryId = null;
					}
                    const firstCategoryId = response.categories.length > 0 ? response.categories[0].category_id : null;
                    if (firstCategoryId) {
                        loadExpensesByCategory(firstCategoryId);
                    }
                } else {
                    console.log(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX error:', textStatus, errorThrown);
            }
        });
    }

    function loadExpensesByCategory(categoryId) {
        $.ajax({
            url: 'finance/expense-handler.php',
            type: 'GET',
            data: { action: 'get_expenses_by_category', category_id: categoryId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const expenseList = $('#expense-list');
                    expenseList.empty(); // Clear existing items
                    response.expenses.forEach(function(expense) {
                        const listItemHtml = `<li>${expense.expense_name}: $${expense.monthly_expenditure}</li>`;
                        expenseList.append(listItemHtml);
                    });
                } else {
                    console.log(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX error:', textStatus, errorThrown);
            }
        });
    }

    $('#expense-form').on('submit', function(event) {
        event.preventDefault();
        const errorContainer = $('#expense-form .error');
        clearAllErrors(errorContainer);

        const expenseName = $('#expense-name').val().trim();
        const monthlyCost = $('#monthly-cost').val().trim();
        const categoryId = $('#expense-category').val();

        if (!expenseName || !monthlyCost || !categoryId) {
            addError(errorContainer, 'All fields are required.');
            return;
        }

        const formData = {
            action: 'add_expense',
            expense_name: expenseName,
            monthly_cost: monthlyCost,
            category_id: categoryId
        };

        $.ajax({
            url: 'finance/expense-handler.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#expense-name').val('');
                    $('#monthly-cost').val('');
                    // Reload expenses for the selected category
                    loadExpensesByCategory(categoryId);
                } else {
                    addError(errorContainer, response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                addError(errorContainer, 'An error occurred while processing your request. Please try again.');
                console.log('AJAX error:', textStatus, errorThrown);
            }
        });
    });

    $('#delete-expense-form').on('submit', function(event) {
        event.preventDefault();
        const errorContainer = $('#delete-expense-form .error');
        clearAllErrors(errorContainer);

        const expenseId = $('#delete-expense').val();

        if (!expenseId) {
            addError(errorContainer, 'Please select an expense to delete.');
            return;
        }

        const formData = {
            action: 'delete_expense',
            expense_id: expenseId
        };

        $.ajax({
            url: 'finance/expense-handler.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Reload expenses for the selected category
                    const selectedCategoryId = $('#expense-category').val();
                    if (selectedCategoryId) {
                        loadExpensesByCategory(selectedCategoryId);
                    }
                } else {
                    addError(errorContainer, response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                addError(errorContainer, 'An error occurred while processing your request. Please try again.');
                console.log('AJAX error:', textStatus, errorThrown);
            }
        });
    });

    $('#expense-category').on('change', function() {
        const categoryId = $(this).val();
        if (categoryId) {
            loadExpensesByCategory(categoryId);
        }
    });

    // Load categories and initial expenses when the page loads
});

