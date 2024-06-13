<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
// define a base url that we can build off of with our other files
// this one works b/c our root for this project is the cs2450 folder.
$baseUrl = 'https://kmclevel.w3.uvm.edu/cs2450';
// define an associative array (kinda like a partial map)
// we are structuring it where keys that are directories point to an
// associated array containing the contents of that directory  
$siteMap = [
	'index.php',
	'wireframe.html', 
	'tablet-wireframe.html',
	'ADMIN' => [
		'code-viewer.php',
		'table-viewer.php',
		'admin.css'
	]
];


function generateSiteMap( $siteMap, $baseUrl ) {
    $html = '';
    foreach ($siteMap as $dir => $content) { 
        if (is_array($content)) { // If the current element points to another array...
            $html .= '<li class="dir">' . $dir; 
            $html .= '<ul class="indent">'; 
            foreach ($content as $file) { // $content is the content of our dir, so they're files.
                // Build the URLs using the baseUrl we defined earlier + the content we defined in the siteMap array
                $html .= '<li><a href="' . $baseUrl . '/' . $dir . '/' . $file . '">' . $file . '</a></li>';
            }
            $html .= '</ul>';
            $html .= '</li>';
        } else { // Otherwise, this is standalone content not contained in a subdirectory.
            $html .= '<li><a href="' . $baseUrl . '/' . $content . '">' . $content . '</a></li>'; 
        }
    }
    return $html;

}

$sitemapHTML = file_get_contents('./sitemap.html');
// start the html structure

$generated_sitemap = generateSiteMap($siteMap, $baseUrl);
file_put_contents('sitemap.log', $generated_sitemap);
//file_put_contents('sitemap.log', "SITEMAPHTML: \n" . $sitemapHTML . "\nGENERATED SITEMAP: \n" . $generated_sitemap, FILE_APPEND);
$newHTML = str_replace('<ul id="dynamic-sitemap"></ul>', '<ul id="dynamic-sitemap">' . $generated_sitemap . '</ul>', $sitemapHTML);
file_put_contents('sitemap.log', "\n\n\n\n\n\n\n\n\n\n\n\n\n NEW ASDASDASDASDASDASDASD \n" . $newHTML, FILE_APPEND);

echo $newHTML;
?>