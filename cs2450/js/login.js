document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        
        const ajax = new XMLHttpRequest();
        ajax.open('POST', 'login.php', true);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        ajax.onload = function() {
            if (ajax.status === 200) {
                const response = JSON.parse(ajax.responseText);
                if (response.success) {
                    window.location.href = 'index.php'; // Redirect to the dashboard
                } else {
                    displayError(response.message); // Display error message
                }
            }
        };
        
        ajax.send(`username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`);
    });

    function displayError(message) {
        let errorElement = document.querySelector('.error');
        if (!errorElement) {
            errorElement = document.createElement('p');
            errorElement.classList.add('error');
            form.insertBefore(errorElement, form.firstChild);
        }
        errorElement.textContent = message;
    }
});

