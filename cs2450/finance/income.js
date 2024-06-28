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

    function loadCategories() {
        $.ajax({
            url: 'finance/income-handler.php',
            type: 'GET',
            data: { action: 'get_income_categories' },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    populateSelect($('#income-category'), response.categories, 'category_id', 'category_name');
                    // Load income sources for the first category by default
                    const firstCategoryId = response.categories.length > 0 ? response.categories[0].category_id : null;
                    if (firstCategoryId) {
                        loadIncomeByCategory(firstCategoryId);
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

    function loadIncomeByCategory(categoryId) {
        $.ajax({
            url: 'finance/income-handler.php',
            type: 'GET',
            data: { action: 'get_income_by_category', category_id: categoryId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const incomeList = $('#income-list');
                    incomeList.empty(); // Clear existing items
                    response.incomes.forEach(function(income) {
                        const listItemHtml = `<li>${income.income_name}: $${income.monthly_income}</li>`;
                        incomeList.append(listItemHtml);
                    });
                } else {
					console.log('Response: ', response);
                    console.log(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
				console.log('AJAX error:', textStatus, errorThrown);
            }
        });
    }

    $('#income-form').on('submit', function(event) {
        event.preventDefault();
        const errorContainer = $('#income-form .error');
        clearAllErrors(errorContainer);

        const incomeName = $('#income-name').val().trim();
        const monthlyIncome = $('#monthly-income').val().trim();
        const categoryId = $('#income-category').val();

        if (!incomeName || !monthlyIncome || !categoryId) {
            addError(errorContainer, 'All fields are required.');
            return;
        }

        const formData = {
            action: 'add_income',
            income_name: incomeName,
            monthly_income: monthlyIncome,
            category_id: categoryId
        };

        $.ajax({
            url: 'finance/income-handler.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#income-name').val('');
                    $('#monthly-income').val('');
                    // Reload income sources for the selected category
                    loadIncomeByCategory(categoryId);
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

    $('#delete-income-form').on('submit', function(event) {
        event.preventDefault();
        const errorContainer = $('#delete-income-form .error');
        clearAllErrors(errorContainer);

        const incomeId = $('#delete-income').val();

        if (!incomeId) {
            addError(errorContainer, 'Please select an income source to delete.');
            return;
        }

        const formData = {
            action: 'delete_income',
            income_id: incomeId
        };

        $.ajax({
            url: 'finance/income-handler.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Reload income sources for the selected category
                    const selectedCategoryId = $('#income-category').val();
                    if (selectedCategoryId) {
                        loadIncomeByCategory(selectedCategoryId);
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

    $('#income-category').on('change', function() {
        const categoryId = $(this).val();
        if (categoryId) {
            loadIncomeByCategory(categoryId);
        }
    });

    // Load categories and initial incomes when the page loads
    loadCategories();
});

