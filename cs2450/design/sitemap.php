<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include($_SERVER['DOCUMENT_ROOT'] . '/cs2450/config.php');
include(ROOT_PATH . 'includes/top.php'); 
?>
<script src="/cs2450/js/sitemap.js"></script>
<noscript>
<ul>
<?php
echo '<script>';
echo 'console.log("no script found");';
echo '</script>';
// This is our script in the event that the user doesnt have js in the browser (like our backup php)
// Define a base URL that we can build off of with our other files
$baseUrl = 'https://kmclevel.w3.uvm.edu/cs2450/';

// Define an associative array (kind of like a partial map)
// We are structuring it where keys are directories pointing to an associated array containing the contents of that directory
$siteMap = [
    'index.php',
    'design' => [
	'wireframe.html',
	'tablet-wireframe.html'
    ],
    'ADMIN' => [
	'code-viewer.php',
	'table-viewer.php',
	'admin.css'
    ]
];

echo generateSiteMap($siteMap, $baseUrl);

function generateSiteMap($siteMap, $baseUrl) {
    $html = '';
    foreach ($siteMap as $dir => $content) {
	if (is_array($content)) { // If the current element points to another array...
	    $html .= '<li class="dir">' . $dir;
	    $html .= '<ul class="indent">';
	    foreach ($content as $file) { // $content is the content of our dir, so they're files.
		// Build the URLs using the baseUrl we defined earlier + the content we defined in the siteMap array
		$html .= '<li><a href="' . $baseUrl . $dir . '/' . $file . '">' . $file . '</a></li>';
	    }
	    $html .= '</ul>';
	    $html .= '</li>';
	} else { // Otherwise, this is standalone content not contained in a subdirectory.
	    $html .= '<li><a href="' . $baseUrl . $content . '">' . $content . '</a></li>';
	}
    }
    return $html;
}
?>
</ul>
</noscript>

<div id="site-map"></div>

<?php include('../includes/footer.php'); ?>

