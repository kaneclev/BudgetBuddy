$(document).ready(function() {
    function addError(errorContainer, message) {
        errorContainer.append('<div class="error">' + message + '</div>');
    }

    function clearAllErrors(errorContainer) {
        errorContainer.empty();
    }

    function addCategoryToList(categoryName, categoryId, categoryType) {
        const listId = categoryType === 'expense' ? '#expense-category-list ul' : '#income-category-list ul';
        const newCategoryHtml = `
            <li>
                ${categoryName}
                <button class="delete-category-btn" data-category-id="${categoryId}" data-category-type="${categoryType}">x</button>
            </li>
        `;
        $(listId).append(newCategoryHtml);
    }

    function handleFormSubmission(formId, inputId, actionType, categoryType) {
        $(formId).on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const errorContainer = $(formId + ' .error');
            clearAllErrors(errorContainer);

            const categoryName = $(inputId).val().trim();

            // Client-side validation
            if (categoryName === '') {
                addError(errorContainer, 'Category name is required.');
                return;
            }

            const formData = {
                action: actionType,
                category_name: categoryName
            };

            console.log('Form Data:', formData); // Debugging statement

            $.ajax({
                url: 'finance/budget-handler.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log('Server response:', response); // Debugging statement
                    if (response.status === 'success') {
                        // Add the new category to the list without reloading
                        addCategoryToList(categoryName, response.category_id, categoryType);
                        $(inputId).val(''); // Clear the input field
                    } else {
                        addError(errorContainer, response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX error:', textStatus, errorThrown); // Debugging statement
                    addError(errorContainer, 'An error occurred while processing your request. Please try again.');
                }
            });
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

            console.log('Delete Data:', formData);

            $.ajax({
                url: 'finance/budget-handler.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log('Server response:', response);
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

    handleFormSubmission('#add-expense-category-form', '#new-expense-category-name', 'add_expense_category', 'expense');
    handleFormSubmission('#add-income-category-form', '#new-income-category-name', 'add_income_category', 'income');
    handleCategoryDeletion();
});

