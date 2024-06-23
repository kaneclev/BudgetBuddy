document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signupForm');
    const usernameInput = document.getElementById('username_signup');
    const passwordInput = document.getElementById('password_signup');
    const confirmPasswordInput = document.getElementById('confirm_password_signup');
	let errorMessages = [];

    function isValidInput(input) {
		if (input === '') {
			return true;
		}
        const regex = /^[a-zA-Z0-9]+$/;
        return regex.test(input);
    }
	

    function displayErrors() {
        const errorElement = document.querySelector('.signup-container .error');
        if (errorElement) {
            errorElement.innerHTML = '';
			for (i = 0; i < errorMessages.length; i++) {
				console.log('Trying to display ' + errorMessages[i][0] + ' ' + errorMessages[i][1]);
				const errorMessage = document.createElement('div');
				errorMessage.textContent = errorMessages[i][1];
				errorElement.appendChild(errorMessage);
				console.log('Look at this: ' + errorElement.innerHTML);	
				
			}
			if (errorMessages.length > 0) {
				errorElement.style.display = 'block';
			} else {
				errorElement.style.display = 'none';
			}
		}
    }
	
	function addError(errorInfo) {
		let errorExists = false;
		for (i = 0; i < errorMessages.length; i++) {
			if (errorMessages[i][0] === errorInfo[0]) {
				errorExists = true;
			}
		}
		if (!errorExists) {
			errorMessages.push(errorInfo);
		}
	
	}
	
    usernameInput.addEventListener('input', function() {
        if (!isValidInput(usernameInput.value)) {	
			addError(['user_chars', 'The username cannot contain any special characters.']);
			displayErrors();
		} else {
            clearErrors('user_chars');
        }
    });

    passwordInput.addEventListener('input', function() {
        if (passwordInput.value.length < 6 && passwordInput.value.length > 0) {
						
			addError(['len', 'The password must be at least 6 characters long.']);
			displayErrors();
		} else {
            clearErrors('len');
        }
		
    });

    confirmPasswordInput.addEventListener('input', function() {
        if (passwordInput.value !== confirmPasswordInput.value) {
			addError(['match', 'The passwords do not match.']);
			displayErrors();
		} else {
            clearErrors('match');
        }
    });

    function clearErrors(errorId, isDisplayed = false) {
		let foundError = false;
        const errorElement = document.querySelector('.signup-container .error');
        if (errorElement) {
			for (i = 0; i < errorMessages.length; i++) {
				if (errorMessages[i][0] === errorId) {
					errorMessages.splice(i, 1);
					foundError = true;
					
					break;
				}
			}
			if (foundError) {
				displayErrors();
			}
        }
    }
});

