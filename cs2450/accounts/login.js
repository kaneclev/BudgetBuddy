/*




*/


$(document).ready(function() {
    $('#loginForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        let username = $('#username').val();
        let password = $('#password').val();
        let errorContainer = $('.login-container .error');

        $.ajax({
            url: '../utils/login-handler.php',
            type: 'POST',
            data: {
                username: username,
                password: password
            },
            dataType: 'json',
            success: function(response) {
                errorContainer.empty(); // Clear previous errors

                if (response.success) {
                    window.location.href = 'index.php'; // Redirect on success
                } else {
                    response.errors.forEach(function(error) {
                        errorContainer.append('<div>' + error + '</div>');
                    });
                }
            },
            error: function() {
                errorContainer.empty();
                errorContainer.append('<div>There was an error processing your request. Please try again.</div>');
            }
        });
    });
});

