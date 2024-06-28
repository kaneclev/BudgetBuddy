<!DOCTYPE HTML>
<html lang="en">

<head>
<meta charset="utf-8">
<title>Your name</title>
<meta name="author" content="Your name">
<meta name="description" content="A site map to all my groovy assignments for the best course at UVM.">

<style>
/* basic CSS */
body {
margin: auto;
padding: 3%;
width: 90%;
display: grid;
}

figure {
border: thin solid darkslategray;
border-radius: 3%;
padding: 3%;
text-align: center;
}

figcaption {
color: #839e99;
font-style: italic;
text-align: center;
}

img {
border-radius: 3%;
max-width: 100%
}

/* Setting up a grid layout for the sitemap page */
body>h1 {
grid-column: 1/2;
grid-row: 1;

}

body>h2 {
grid-column: 1/2;
grid-row: 2;

}

body>p {
grid-column: 1/2;
grid-row: 3;
}

figure {
border: thin solid darkslategray;
border-radius: 3%;
padding: 3%;
text-align: center;
grid-column: 2 / 2;
grid-row: 1 / span 3;
}

.header {
grid-area: header;
grid-column: 1 / 3;
padding: .5%;
margin: .5%;
}

.lab-layout {
border-bottom: thin dashed navy;
display: inline-grid;
grid-template-columns: 25% 25% 50%;
grid-template-areas: "header header header"
"public-files supporting-files grader-notes";
padding: .5%;
margin: .5%;
grid-column: 1 / span 2;
}

.public-files {
grid-area: public-files;
padding: .5%;
margin: .5%;
}

.supporting-files {
grid-area: supporting-files;
padding: .5%;
margin: .5%;
}

.grader-notes {
grid-area: grader-notes;
padding: .5%;
margin: .5%;
}
</style>

</head>

<body>
<figure>
<img alt="Bob Erickson circ- 1982" src="images/bob-erickson.png">
<figcaption>Heading off to my first Computer class.</figcaption>
</figure>

<h1>CS 2450 - Summer 2024 </h1>
<h2>Your Name - Site map</h2>
<p><a href="ADMIN/code-viewer.php">My Admin Folder</a></p>

<!-- ########################################### -->
<section class="lab-layout">
<h2 class="header">Final Project - <em>General title for your site</em>.</h2>
<section class="public-files">
<h3>Public Files</h3>
<p><a href="live-final/about.php">About page</a></p>
<p><a href="live-final/array.php">Array page</a></p>
<p><a href="live-final/detail.php">Detail page</a></p>
<p><a href="includes/form.php">Form page</a></p>
<p><a href="live-final/index.php">Home page</a></p>
</section>

<section class="supporting-files">
<h3>Supporting files</h3>
<p><a href="live-final/css/custom.css">css style sheet</a></p>
<p><a href="final/css/layout-desktop.css">desktop style sheet</a></p>
<p><a href="final/css/layout-tablet.css">tablet style sheet</a></p>
<p><a href="final/css/layout-phone.css">phone style sheet</a></p>
<p><a href="final/images/wireframe.png">Wireframe</a></p>

<h3>JavaScript</h3>
<p><a href="final/nameoffile.js">name of js file</a></p>
<p><a href="final/nameoffile.js">repeat as many times as needed</a></p>

</section>

<section class="grader-notes">
<h3>Notes to grader</h3>
<p>Give me a brief descirption of the project</p>
</section>
</section>
<!-- ########################################### -->
</body>

</html>
