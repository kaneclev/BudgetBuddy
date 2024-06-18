document.addEventListener('DOMContentLoaded', function() {
	const baseUrl = 'https://kmclevel.w3.uvm.edu/cs2450/';
	const siteMap = {
	'index.php': '',
	'design': [
	    'wireframe.html',
	    'tablet-wireframe.html'
	],
	'ADMIN': [
	    'code-viewer.php',
	    'table-viewer.php',
	    'admin.css'
	]
	};

	function generateSiteMap(siteMap, baseUrl) {
		// this function is going to be the main script that we try and run if js is active in the browser
		// extremely similar to our original php func, we just create the html with different syntax
		// declare the var html first....
		let html = '';
		for (const dir in siteMap) {
			if (Array.isArray(siteMap[dir])) {
				html += '<li class="dir">' + dir;
				html += '<ul class="indent">';
				// since this element is an array, we account for the elements in that array
				for (const file of siteMap[dir]) {
					html += '<li><a href="' + baseUrl + file + '">' + file + '</a></li>';
				}			
				html += '</ul>';
				html += '</li>';
			} else {
				html += '<li><a href="' + baseUrl + dir + '">' + dir + '</a></li>';
			}
		}
		return html;
	}

	const siteMapContainer = document.getElementById('site-map');
	if (siteMapContainer) {
		siteMapContainer.innerHTML = generateSiteMap(siteMap, baseUrl);
	
	}

});
