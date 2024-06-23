$(document).ready(function() {
	
    let errorContainer = $('.signup-container .error');

    /* 
		The following functions are all trying to do similar things;
			- Recognize a problem as the user inputs text into the form
			- Update the errorContainer that we are identifying as the .signup-container
				div with jquery
			- Add/Remove html elements as the user causes/fixes errors.

		What is considered an error?
		- Special characters in username
		- Password not long enough
		- Passwords dont match

		If the script identifies any of these cases, then it tells JQuery to add an error to the div.
	*/

	function addError(message) {
        errorContainer.append('<div class="error">' + message + '</div>');
    }

    function clearError(message) {
        errorContainer.find('.error').each(function() {
            if ($(message).text() === message) {
                $(message).remove();
            }
        });
    }

    $('#username_signup').on('input', function() {
        const username = $('#username_signup').val();
        const invalidCharMessage = 'The username cannot contain any special characters.';
        const whitespaceMessage = 'The username cannot contain spaces.';

        if (!/^[a-zA-Z0-9]*$/.test(username)) {
            if (!errorContainer.text().includes(invalidCharMessage)) {
                addError(invalidCharMessage);
            }
        } else {
            clearError(invalidCharMessage);
        }

        if (/\s/.test(username)) {
            if (!errorContainer.text().includes(whitespaceMessage)) {
                addError(whitespaceMessage);
            }
        } else {
            clearError(whitespaceMessage);
        }
    });

    $('#password_signup').on('input', function() {
        const password = $('#password_signup').val();
        const lengthMessage = 'The password must be at least 6 characters long.';

        if (password.length < 6) {
            if (!errorContainer.text().includes(lengthMessage)) {
                addError(lengthMessage);
            }
        } else {
            clearError(lengthMessage);
        }
    });


		
    $('#confirm_password_signup').on('input', function() {
        const password = $('#password_signup').val();
        const confirmPassword = $('#confirm_password_signup').val();
        const matchMessage = 'The passwords do not match.';

        if (password !== confirmPassword) {
            if (!errorContainer.text().includes(matchMessage)) {
                addError(matchMessage);
            }
        } else {
            clearError(matchMessage);
        }
    });


	/*

		This submit event listener via jquery will do the following:
			- Prevent empty form submissions
			- Use AJAX to make a get request to signup-handler.php
			- Recieve the POST response as json
			Success case:
				- Clear errors.
				- Redirect to dashboard after setting session variables.
			Fail Case:
				- Show errors. 
				- Wait for another response.
				- Handle exceptions if they are thrown.
	*/
	$('#signupForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        let username = $('#username_signup').val();
        let password = $('#password_signup').val();
        let confirmPassword = $('#confirm_password_signup').val();

        $.ajax({
            url: 'accounts/signup-handler.php',
            type: 'POST',
            data: {
                action: 'signup',
                username_signup: username,
                password_signup: password,
                confirm_password_signup: confirmPassword
            },
            dataType: 'json',
            success: function(response) {
				console.log('AJAX success response:', response);
                errorContainer.empty(); // Clear previous errors

                if (response.success) {
                    window.location.href = 'index.php'; // Redirect on success
                } else {
                    response.errors.forEach(function(error) {
                        errorContainer.append('<div>' + error + '</div>');
                    });
                }
            },
            error: function(response) {
				console.log('ajax fail response: ', response);
                errorContainer.empty();
                errorContainer.append('<div>There was an error processing your request. Please try again.</div>');
            }
        });
    });
});

