$(document).ready(function() {
	
    let errorContainer = $('.signup-container .error');

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
                    window.location.href = 'login.php'; // Redirect on success
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

