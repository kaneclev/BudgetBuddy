<?php 
// define a base url that we can build off of with our other files
// this one works b/c our root for this project is the cs2450 folder.
$baseUrl = 'https://kmclevel.w3.uvm.edu/cs2450';
// define an associative array (kinda like a partial map)
// we are structuring it where keys that are directories point to an
// associated array containing the contents of that directory  
$siteMap = [
	'index.php', 
	'ADMIN' => [
		'code-viewer.php',
		'table-viewer.php',
		'admin.css'
	]
];
// start the html structure
echo '<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitemap</title>
    <style>
        body {
            	font-family: Arial, sans-serif;
            	background-color: #000;
            	color: #fff; 
        	padding: 20px;
        }
	
        ul {
        	list-style-type: none;
        	padding: 0;
        }
        li {
        	margin: 5px 0;
        }
        a {
        	text-decoration: none;
        	color: #007BFF;
        }
        a:hover 
        	text-decoration: underline;
        }
        .dir { 
        	font-weight: bold;
        }
	.indent { 
		padding-left: 20px;	 
	}
    </style>
</head>
<body>
    <h1>Sitemap</h1>
    <h2 id="greet-by-time"></h2>
    <script>
	function greetByTime() {
		var curr_date = new Date();
		var curr_time = curr_date.getHours();
		var greeting; // Initialize greeting 
		if (curr_time >= 6 && curr_time < 12) {
			greeting = "Good Morning!";
		} else if (curr_time >= 12 && curr_time < 18) {
			greeting = "Good Afternoon!";
		} else {
			greeting = "Welcome to Late Night Live!";
		}
		document.getElementById("greet-by-time").innerText = greeting;
	}
	greetByTime();
    </script>
    <ul>';
	
echo '<ul>';
// since we made the site structure manually, we can loop through the array we made
// and generate the formatting based on the contents of the array
foreach ($siteMap as $dir => $content) { 
	if (is_array($content)) { // if the current element points to another array...
		echo '<li class="dir">' . $dir; 
		echo '<ul class="indent">'; 
		foreach ($content as $file) { // $content is the content of our dir, so theyre files.
			// build the urls using the baseUrl we defined earlier + the content we defined in the siteMap array
			echo '<li><a href="' . $baseUrl . '/' . $dir . '/' . $file . '">' . $file . '</a></li>';
		}
		echo '</ul>';
		echo '</li>';
	} else { // otherwise, this is standalone content not contained in a subdirectory.
		echo '<li><a href="' . $baseUrl . '/' . $content . '">' . $content . '</a></li>'; 
	}
}
echo '</ul>
</body>
</html>';

?>

