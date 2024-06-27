
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
    
