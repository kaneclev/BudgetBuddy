/*




*/


$(document).ready(function() {
    
    let errorContainer = $('.login__container .error');
	
	$('#loginForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        let username = $('#username').val();
        let password = $('#password').val();

        $.ajax({
            url: 'accounts/login-handler.php',
            type: 'POST',
            data: {
                username: username,
                password: password
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
				console.log(response)
				console.log('AJAX error response: ', response.errors);
                errorContainer.empty();
                errorContainer.append('<div>There was an error processing your request. Please try again.</div>');
            }
        });
    });

	$('#username, #password').on('input', function() {
		errorContainer.empty();
		});

});




