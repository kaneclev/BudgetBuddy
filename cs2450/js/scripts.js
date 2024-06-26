
// definitions for global scope vars
// globally define some object that i can use like a map for k-v pairs for my sess data
let sess_map;

// function for retrieving session variables via ajax from get-session-data.php

async function getSessionData() {
    const data_path = 'utils/get-session-data.php';
    const response = await fetch(data_path);
    const data = await response.json();
    return data;
}


// function for loading in elements from the json file from getSessionData()


document.addEventListener('DOMContentLoaded', async function() {
	let content = document.getElementById('dashboard');
	let root_filepath = content.getAttribute('root_path');
	let curr_page = window.location.pathname;
	let root = '/cs2450/';	
	sess_map = await getSessionData(); 	
 
	console.log(curr_page);
	loadDashboard(content);
});



function loadDashboard(content) {
	if (content) {
		// Init session variables as null until we can confirm they exist
		let logged_in = null;
		let username = null;
		let user_id = null;
		// Check to see if logged_in is even present in the sess_map
		if ('logged_in' in sess_map) {
			logged_in = sess_map.logged_in;
		}
		// if it is present, and it is true...
		if (logged_in) {
			username = sess_map.username;
			user_id = sess_map.user_id;
			content.innerHTML = `
				<div class="dashboard">
                    <div class="header">
                        <h2>Welcome back, ${username}</h2>
                    </div>
                    <div class="synopsis">
                        <p>Overview of your financial plan</p>
                    </div>
                    <div class="graphic" id="dashboardGraphic">
                        <p>*insert relevant graphic*</p>
                    </div>
                </div>
            `;	

		} else {
			content.innerHTML = `
				<div class="dashboard">
					<div class="header">
						<h2>Dashboard</h2>
					</div>
					<div class="synopsis">
						<p>Synopsis of the purpose and utility of the financial planner</p>
					</div>
					<div class="graphic" id="dashboardGraphic">
						<p>*insert relevant graphic*</p>
					</div>
				</div>
			`;
		}
        addEventListeners(logged_in); // Pass logged_in to the function
    }
}

function addEventListeners(logged_in) {

	const sitemap_button = document.getElementById('siteMapButton');
	if (sitemap_button) {
		console.log("sitemap button exists");
		
		sitemap_button.addEventListener('click', function() {
			window.location.href = 'design/sitemap.php';
		});
	}
				    
	// If the page we are on is the dashboard, add event listeners to buttons in the dashboard
}

window.addEventListener('scroll', function() {
    var loginContainer = document.querySelector('.login-container');
    var signupContainer = document.querySelector('.signup-container');
    var headerHeight = document.querySelector('.main-header').offsetHeight;
	var navbarHeight = document.querySelector('.nav').offsetHeight;

    if (window.scrollY >= headerHeight || window.scrollY >= navbarHeight) {
        loginContainer.classList.add('fixed');
        signupContainer.classList.add('fixed');
    } else {
        loginContainer.classList.remove('fixed');
        signupContainer.classList.remove('fixed');
    }
});
    
