document.addEventListener('DOMContentLoaded', function() {
    let curr_page = window.location.pathname;
    const root = '/cs2450/'; // Ensure the leading slash is included to match the pathname correctly
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
    const content = document.getElementById('content');
    if (content) {
        console.log("Content div found"); // Debug
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
    
