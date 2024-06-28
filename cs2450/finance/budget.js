$(document).ready(function() {
    function addError(errorContainer, message) {
        errorContainer.append('<div class="error">' + message + '</div>');
    }

    function clearAllErrors(errorContainer) {
        errorContainer.empty();
    }

    function addCategoryToList(categoryName, categoryId, categoryType, description) {
        const listId = categoryType === 'expense' ? '#expense-category-list ul' : '#income-category-list ul';
        const newCategoryHtml = `
            <li>
                <span class="category-name">${categoryName}</span>
                <button class="delete-category-btn" data-category-id="${categoryId}" data-category-type="${categoryType}">x</button>
                <button class="expand-category-btn" data-category-id="${categoryId}" data-category-type="${categoryType}">+</button>
                <button class="show-description-btn" data-category-id="${categoryId}" data-description="${description}">Show Description</button>
				<div class="category-description" style="display: none;"></div>
				<ul class="items-list" style="display: none;"></ul>
            </li>
        `;
        $(listId).append(newCategoryHtml);
    }

    function handleFormSubmission(formId, inputId, actionType, categoryType, descriptionId) {
        $(formId).off('submit').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const errorContainer = $(formId + ' .error');
            clearAllErrors(errorContainer);

            const categoryName = $(inputId).val().trim();
			const description = $(descriptionId).val().trim();
            // Client-side validation
            if (categoryName === '') {
                addError(errorContainer, 'Category name is required.');
                return;
            }
            const formData = {
                action: actionType,
                category_name: categoryName,
				description: description
            };

            $.ajax({
                url: 'finance/budget-handler.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Add the new category to the list without reloading
                        addCategoryToList(categoryName, response.category_id, categoryType, description);
                        $(inputId).val(''); // Clear the input field
						$(descriptionId).val('');
					} else {
                        addError(errorContainer, response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    addError(errorContainer, 'An error occurred while processing your request. Please try again.');
                }
            });
        });
    }

    function loadCategories() {
        $.ajax({
            url: 'finance/budget-handler.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.expense_categories) {
                    response.expense_categories.forEach(function(category) {
                        addCategoryToList(category.category_name, category.category_id, 'expense');
                    });
                }
                if (response.income_categories) {
                    response.income_categories.forEach(function(category) {
                        addCategoryToList(category.category_name, category.category_id, 'income');
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX error:', textStatus, errorThrown);
            }
        });
    }

    function handleCategoryDeletion() {
        $(document).on('click', '.delete-category-btn', function() {
            const categoryId = $(this).data('category-id');
            const categoryType = $(this).data('category-type');
            const formData = {
                action: 'delete_category',
                category_id: categoryId,
                category_type: categoryType
            };

            $.ajax({
                url: 'finance/budget-handler.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Remove the category from the list without reloading
                        $(`button[data-category-id='${categoryId}'][data-category-type='${categoryType}']`).closest('li').remove();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX error:', textStatus, errorThrown);
                    alert('An error occurred while processing your request. Please try again.');
                }
            });
        });
    }

    
	function handleShowDescription() {
	 $(document).on('click', '.show-description-btn', function() {
            const $this = $(this);
            const categoryId = $this.data('category-id');
            const descriptionContainer = $this.siblings('.category-description');

            if (descriptionContainer.is(':visible')) {
                descriptionContainer.slideUp();
                $this.text('Show Description');
            } else {
                $.ajax({
                    url: 'finance/budget-handler.php',
                    type: 'POST',
                    data: {
                        action: 'get_description_by_category_id',
                        category_id: categoryId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            const description = response.description;
                            descriptionContainer.html(description);
                            descriptionContainer.slideDown();
                            $this.text('Hide Description');
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('AJAX error:', textStatus, errorThrown);
                        alert('An error occurred while fetching the description. Please try again.');
                    }
                });
            }
        });
    }



	function handleCategoryExpansion() {
        $(document).on('click', '.expand-category-btn', function() {
            const $this = $(this);
            const categoryId = $(this).data('category-id');
            const categoryType = $(this).data('category-type');
            const itemsList = $(this).siblings('.items-list');
            const formData = {
                action: categoryType === 'expense' ? 'get_expenses' : 'get_incomes',
                category_id: categoryId
            };

            if (itemsList.is(':visible')) {
                itemsList.slideUp();
                $(this).text('+');
            } else {
                $.ajax({
                    url: 'finance/budget-handler.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            itemsList.empty();
                            const items = categoryType === 'expense' ? response.expenses : response.incomes;
                            items.forEach(function(item) {
                                const itemHtml = `<li>${item.expense_name || item.income_name}: ${item.monthly_expenditure || item.monthly_income}</li>`;
                                itemsList.append(itemHtml);
                            });
                            itemsList.slideDown();
                            $this.text('-');
                        } else {
                            console.log(response);
                            alert(response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('AJAX error:', textStatus, errorThrown);
                        alert('An error occurred while fetching items. Please try again.');
                    }
                });
            }
        });
    }

    // Load categories when the page loads
    loadCategories();

    handleFormSubmission('#add-expense-category-form', '#new-expense-category-name', 'add_expense_category', 'expense', '#description');
    handleFormSubmission('#add-income-category-form', '#new-income-category-name', 'add_income_category', 'income', '#description');
    handleCategoryDeletion();
    handleCategoryExpansion();
	handleShowDescription();
});

