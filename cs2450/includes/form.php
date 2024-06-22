<?php 
/*
	purpose of form.php
		- To make an abstract definition of a form that we can use across the site
			so that we dont have to rewrite code for our forms over and over
		HOWEVER:
			We have to be careful not to make our form.php too specific
			because this would cause us to have to do a lot of wrangling and specifying
			each time we use form.php, which kind of defeats the whole purpose of this
		There are a few simple components for the forms which we know each one will need:
			- The form tag
			- A label
			- An input type
				- This can vary from email, text, password, etc.
			- A way to submit the form
		Given these definitions, we can make a function to render a basic form from anywhere in our site
		and then tune this form to our liking depending on where we are using it. 

*/
// So, to follow our plan, we start with the top of the 'shell' of each form
function renderFormStart($formId, $action, $method) {
	// Init the starting form tag with the args passed to us
	echo "<form id='$formid' action='$action' method='$method'>";
}

/*
	In here is where the file which calls us will put their logic and design
*/

// Some helper functions for ease of creation when other files use form.php

// Create a text input field where the user inserts text (like for usernames, passwords, etc.)
function renderTextInputField($type, $id, $name, $label) {
	echo "<label for='$id'>$label</label>";
	echo "<input type='$type' id='$id' name='$name' required>";
	echo "<br>";
}

// Create a textarea input field where the user can input multiple lines of text
function renderTextareaField($id, $name, $label) {
	echo "<label for='$id'>$label</label>";
	echo "<textarea id='$id' name='$name' required></textarea>";
	echo "<br>";

}

// This is the end of the 'shell' for our form
function renderFormEnd($submitLabel) {
	echo "<button type='submit'>$submitLabel</button>";
	echo "<p class='error' style='display:none;'></p>";
	echo "</form>";
}
  



?>
