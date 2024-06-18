# Budget Buddy
## My CS2450 Final Project

### Requirement Map

### Website Requirements
Source: [CS1080 Final Project Requirements](https://rerickso.w3.uvm.edu/BS/cs1080/assignments/final.php)

**File Requirements**
- [x] Minimum of 4 web pages
    - [ ] 200 Words Per Page for at least 3 pages (login page doesn't need this)
- [ ] A sitemap (sitemap.php) which reflects the final project
    - [ ] Sitemap pushed to repo (commit message: Final project: updated site map)
- [ ] Wireframes for the site linked on sitemap
    - [ ] Desktop wireframe named wireframe-desktop.png
    - [ ] Tablet wireframe named wireframe-tablet.png
    - [ ] Phone wireframe named wireframe-phone.png
    - [ ] Wireframes pushed to repo with commit message 'Final project: created wireframes'
- [x] top.php should reflect final project
- [x] header.php should reflect final project
- [x] nav.php should reflect final project
    - [ ] nav.php should have an if-statement to print the current active page
- [ ] footer.php should reflect final project
- [ ] connect-DB.php
    - [ ] connect-DB.php should be included in top.php
- [ ] css file has styles for the active page (assuming this means there should be styling for all my pages)
- [ ] detail.php - has detail page 1 and 2 (not sure what this is yet, maybe an explanation of what my site is?)

**Form Requirements**
- [ ] form.php - a file defining form interactions that I can use around in different places around the site
- [ ] a text box for the user's email address
    - [ ] two additional text boxes
- Choose at least two of the following: 
    - [ ] Include 3 check boxes
    - [ ] Include 3 radio buttons
    - [ ] Include 1 list box
    - [ ] Include a text area

**Validation Requirements**
- [ ] Sanitize all data in the same order the fields appear on the form
- [ ] Your form should use client side validation as described in the text for HTML5 form validation attributes.
- [ ] Check for empty for all required inputs.
- [ ] You must validate all your widgets

**Form Feature Requirements**
- [ ] You must initialize your PHP default variables in the same order they appear on the form
- [ ] All widgets must be sticky
- [ ] The 'email' form must email the person who fills it out
    - [ ] The 'from' address must be my email address so he can reply to it 

**Database Requirements**
- [ ] Use phpMyAdmin to save information submitted through forms on the site
    - Note: The form should auto insert data into the database, and the table-view.php file should be working
- [ ] Database table names should be good and descriptive.
- [ ] Database field names should be good and descriptive.
- [ ] All form data should be saved to a database table.
- [ ] No printing the post array from the form.
- [ ] Create a new MySQL table to be used for content of your website (like lab 8) using phpMyAdmin. This is not the same table as your form.
- [ ] Save all SQL statements in the file sql.php in the same format as previously.
- [ ] Have at least five records in your MySQL table to display data on a web page.
- [ ] One page should open a MySQL data table and display the information in some way.
    - [ ] Identify the page that displays data on your sitemap.

**CSS/Styling Requirements**
- [ ] Pick a grid or flex-box design for your layout for all pages. Only use one of them. It is wrong if you use both grid and flex.
- [ ] Link to the desktop CSS file (custom.css) with the link element.
- [ ] Link to the tablet CSS file with the link element.
- [ ] Link to the phone CSS file with the link element.
- [ ] Create the CSS for your desktop design, custom.css.
    - [ ] You are graded on the quality of your desktop design.
- [ ] Create the CSS for your phone design.
    - [ ] You are graded on the quality of your phone design.
- [ ] Create the CSS for your tablet design.
    - [ ] You are graded on the quality of your tablet design.
- [ ] Do not duplicate rules in your tablet CSS that are already in custom.css or phone.css.
- [ ] Don't let text get longer than 70 to 80 characters on each line.
    - Generally, this is for the body element.
- [ ] Add the viewport tag to the head section of each page.

**Etc. Requirements**
- [ ] Create a 1-minute walkthrough video describing my project (Budget Buddy)
    - [ ] Link this video on the sitemap
- [ ] Delete all files in the final folder not being used for this assignment.
- [ ] Make sure paragraph, lists, forms text is not centered. Centering boxes is okay.
- [ ] Make sure your table-viewer link is working
- [ ] Include a link to sql.php on your main index under supporting documents.
- [ ] Include a link to records.png on your main index under supporting documents.
- [ ] (5% of your grade) Make sure your files all pass w3c HTML validation: [validator.w3.org](https://validator.w3.org/) NOTE: there should be no warnings or errors.
- [ ] (5% of your grade) Make sure your files all pass w3c CSS validation: [validator.w3.org](https://validator.w3.org/) NOTE: there should be no warnings or errors.

**Submission Requirements**
- [ ] Submit your assignment only once in BrightSpace. Include what section you are in: Section A (B, C, D, OL) as part of the text.
    - Include a hyperlink to your sitemap that opens in a new window. (see official requirements for code to do this)
