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
	
   



	$('#add-category-btn').on('click', function(event) {
		event.preventDefault(); // Prevent default form submission

		const errorContainer = $('#add-category-form .error');
		clearAllErrors(errorContainer);

		const categoryName = $('#new-category-name').val();

		// Client-side validation
		if (categoryName === '') {
			addError(errorContainer, 'Category name is required.');
		}

		// Check if there are any error messages
		if (errorContainer.children().length === 0) {
			const formData = {
				action: 'add_category',
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
						loadExpenses();
					} else {
						addError(errorContainer, response.message);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log('AJAX error:', textStatus, errorThrown); // Debugging statement
					addError(errorContainer, 'An error occurred while processing your request. Please try again.');
				}
			});
		}
	});
	

	$('#delete-category-btn').on('click', function(event) {
		event.preventDefault();
		const errorContainer = $('#delete-category-form .error');
		clearAllErrors(errorContainer);
		const categoryName = $('#new-category-name').val();
		
		// verify that there was a category name input
		if (categoryName === '') {
			addError(errorContainer, 'Category name is required.');

		}



	});

    });

