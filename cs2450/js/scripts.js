document.addEventListener('DOMContentLoaded', function() {
	function loadDashboard() {
		console.log("loadDashboard function is being called"); // Debug
		const content = document.getElementById('content');
		if (content) {
			console.log("Content div found"); // Debug
			console.log("testing changes");
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
		document.getElementById("loginSignupButton").addEventListener('click', function() {
			window.location.href = 'login.php';
		
		});
		
		} else {
			console.log("Content div not found"); // another debug
		}


	}
	loadDashboard();
});

