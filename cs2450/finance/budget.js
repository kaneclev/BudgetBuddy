$(document).ready(function() {


    function addError(errorContainer, message) {
		console.log('add error was just told to add this message: ', message);
        errorContainer.append('<div class="error">' + message + '</div>');
    }

    function clearError(errorContainer, message) {
        errorContainer.find('.error').each(function() {
            if ($(this).text() === message) {
                $(this).remove();
            }
        });
    }

    function clearAllErrors(errorContainer) {
        errorContainer.empty();
    }
	
	loadExpenses();
   
	 function loadExpenses() {
        $.ajax({
            url: 'finance/budget-handler.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const expenseCategory = $('#expense-category');
                const deleteExpense = $('#delete-expense');
                const expensesList = $('#expenses-list');

                expenseCategory.empty();
                deleteExpense.empty();
                expensesList.empty();

                let categoriesExist = false;

                if (data.categories && data.categories.length > 0) {
                    categoriesExist = true;
                    data.categories.forEach(function(category) {
                        expenseCategory.append(new Option(category.category_name, category.category_id));
                    });
                }
                expenseCategory.append(new Option('Add New Category...', 'add_category'));

                if (data.expenses && data.expenses.length > 0) {
                    data.expenses.forEach(function(expense) {
                        deleteExpense.append(new Option(expense.expense_name, expense.expense_id));
                        
                        const expenseItem = $('<div class="expense-item"></div>');
                        expenseItem.text(`Name: ${expense.expense_name}, Category: ${expense.category_name}, Monthly Cost: $${expense.monthly_expenditure}`);
                        expensesList.append(expenseItem);
                    });
                }

                if (!categoriesExist) {
                    $('#expense-category-container').hide();
                    $('#add-category-form').show();
                } else {
                    $('#expense-category-container').show();
                    $('#add-category-form').hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                const errorContainer = $('#expenses-list .error');
                addError(errorContainer, 'An error occurred while loading the budget data. Please try again.');
            }
        });
    }







	 $('#add-expense-btn').on('click', function(event) {
        event.preventDefault(); // Prevent default form submission
		const errorContainer = $('#expense-form .error');
        clearAllErrors(errorContainer);
        
        const expenseName = $('#expense-name').val();
        const expenseCategory = $('#expense-category').val();
        const monthlyCost = $('#monthly-cost').val();

        // Client-side validation
        if (expenseName === '') {
            addError(errorContainer, 'Expense name is required.');
        }
        if (monthlyCost === '' || monthlyCost <= 0) {
			addError(errorContainer, 'Monthly cost must be a positive number.');
        }

        if (errorContainer.children().length === 0) {
            const formData = {
                action: 'add_expense',
                expense_name: expenseName,
                expense_category: expenseCategory,
                monthly_cost: monthlyCost
            };

            $.ajax({
                url: 'finance/budget-handler.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        loadExpenses();
                    } else {
                        addError(errorContainer, response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX threw an error when trying to add an expense: ', textStatus, jqXHR);
					addError(errorContainer, 'An error occurred while processing your request. Please try again.');
                }
            });
        } else {
			console.log('cant send add_expense because error container length > 0');
			console.log('This is the error container: ', errorContainer.html());
			console.log('This is the error container length: ', $('.error-container').length);
		}
    });

    $('#delete-expense-btn').on('click', function(event) {
        event.preventDefault(); // Prevent default form submission
		const errorContainer = $('#delete-expense-form .error');
        clearAllErrors(errorContainer);

        const expenseId = $('#delete-expense').val();

        if (expenseId === null) {
            addError(errorContainer, 'Please select an expense to delete.');
            return;
        }

        const formData = {
            action: 'delete_expense',
            expense_id: expenseId
        };

        $.ajax({
            url: 'finance/budget-handler.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    loadExpenses();
                } else {
                    addError(errorContainer, response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX threw an error when trying to delete an expense: ', errorThrown);
				addError(errorContainer, 'An error occurred while processing your request. Please try again.');
            }
        });
    });

    });

