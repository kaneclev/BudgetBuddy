
// definitions for global scope vars
let content;
let root;
let root_filepath;
// globally define some object that i can use like a map for k-v pairs for my sess data
let sess_map = {};

// function for retrieving session variables via ajax from get-session-data.php
async function getSessionData() {
	data_path = root_filepath + 'utils/get-session-data.php';
	return fetch(data_path)
		.then(response => response.json())
		.then(data => data);

}

// function for loading in elements from the json file from getSessionData()


document.addEventListener('DOMContentLoaded', async function() {
	content = document.getElementById('content');
	root_filepath = content.getAttribute('root_path');
	root = '/cs2450/';
	let curr_page = window.location.pathname;
	
	sess_map = await getSessionData(); 	
 
	console.log(curr_page); 
    
	switch (curr_page) {
        case root:
            loadDashboard(curr_page);
            break;
	case root + 'index.php':
	    
	    loadDashboard(curr_page);
        case root + 'login.php':
            addEventListeners(curr_page); // Pass curr_page to the function
            break;
        default:
            console.log("No function developed for this page...");
    	    console.log(root + 'index.php');
	}
});

function loadDashboard(curr_page) {
    console.log("loadDashboard function is being called"); // Debug
    if (content) {
        console.log("Content div found"); // Debug
		if (logged_in) {
			const username = 
			content.innerHTML = `
				<div class="dashboard">
                    <div class="header">
                        <h2>Welcome Back!</h2>
                        <button class="logout-btn" id="logoutButton">Log Out</button>
                    </div>
                    <div class="synopsis">
                        <p>Overview of your financial planner</p>
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
						<button class="login-signup-btn" id="loginSignupButton">Login/Sign Up</button>
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
        addEventListeners(curr_page); // Pass curr_page to the function
    }
}

function addEventListeners(curr_page) {
    console.log("Adding event listeners to buttons. ");
    
   // Sitemap button will be loaded regardless of our current page, as it is a property of the footer. 
        // We know that footer.php occurs on all pages, and therefore the sitemap button will as well.
            const sitemap_button = document.getElementById('siteMapButton');
                if (sitemap_button) {
			console.log("sitemap button exists");
                        sitemap_button.addEventListener('click', function() {
                                    window.location.href = 'design/sitemap.php';
		    });
		}
				    
	// If the page we are on is the dashboard, add event listeners to buttons in the dashboard
	    if (curr_page === '/cs2450/' || curr_page === '/cs2450/index.php') {
		    const login_button = document.getElementById('loginSignupButton');
		    if (login_button) {
			login_button.addEventListener('click', function() {
				window.location.href = 'login.php';
			    });
		    } else {
			console.log("loginSignupButton not found"); // another debug
			}													 
		}
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
    
