document.addEventListener('DOMContentLoaded', function() {
	const form = document.getElementById('loginForm');
	const usernameInput = document.getElementById('username');
	const passwordInput = document.getElementById('password');
	
	let errorElement = document.querySelector('.error');
    if (!errorElement) {
        errorElement = document.createElement('p');
        errorElement.classList.add('error');
        form.insertBefore(errorElement, form.firstChild);
    }

	// this is my event listener for when they submit the form
	form.addEventListener('submit', function(event) {
		event.preventDefault(); // Prevent the default form submission
		loadDoc('login.php');		
	});
	
	// this is an event listener for their typing so that we can detect invalid chars before they submit
	usernameInput.addEventListener('input', function() {
		if (!isValidInput(usernameInput.value)) {
			displayError('Only letters and numbers are allowed in the username.');
		} else {
			clearError();
		}

	});
	
	function loadDoc(url) {

		let ajax = new XMLHttpRequest();
		if (ajax != null) {
			ajax.onreadystatechange = function() {
				stateChange(ajax);
			};
			ajax.open("POST", url, true);
			ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

			const username = document.getElementById('username').value;
			const password = document.getElementById('password').value;

			// Validate input
			if (!isValidInput(username)) {
				displayError('Only letters and numbers are allowed in the username.');
				return;
			}

			ajax.send(`username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`);
		} else {
			alert("Your browser does not support XMLHTTP.");
		}

	}

	
    function stateChange(ajax) {
		if (ajax.readyState === 4) { // 4 = "loaded"
            if (ajax.status === 200) { // 200 = "OK"
		
				try {
                    const response = JSON.parse(ajax.responseText);
                    if (response.success) {
                        window.location.href = 'index.php'; // Redirect to the dashboard
                    } else {
                        displayError(response.message); // Display error message
                    }
                } catch (e) {
                    displayError("Invalid server response: " + ajax.responseText);
                    console.error("Error parsing JSON response:", e);
                }
            } else {
                displayError("Problem retrieving data: " + ajax.statusText);
            }

	
        }
    }
	

	function isValidInput(input) {
		if (input === '') {
			return true;
		} else {
			const regex = /^[a-zA-Z0-9]+$/; // Only allow letters and numbers
			return regex.test(input);
		}    
	}


	function displayError(message) {
		errorElement.textContent = message;
		errorElement.style.display = 'block';
	}
	
	function clearError() {
		errorElement.textContent = '';
		errorElement.style.display = 'none';
	}


});

