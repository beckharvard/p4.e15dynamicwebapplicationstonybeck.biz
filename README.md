p4.e15dynamicwebapplicationstonybeck.biz
========================================

Project 4

    
    My application is an attempt to replicate some functionality of a content-creation
    and content management system created at the company I work for. The 3gether tool 
    allows for a user to enter a brief text, to style that texts font, color, font size,
    allowing for a background color, a border, border width and border color. Additionally 
    the user can upload images to a personal gallery, can see those pictures when adding 
    content, can add (currently only one) image to the canvas. Once the image has been 
    added the user can (in edit mode) resize or remove the image.  Both the text and the 
    image are dragable and the location to which the content was dragged is persisted.
    
    So, users can, add content, edit that content, store and retrieve that content for 
    later use, and share viewable copies of the content if other users opt to follow. 
	Eventually I hope to: handle saves using ajax calls (moving the add content and save 
	content into one module or a single PHP page). Additionally I will be working to 
	ensure that separate DB tables store all the style attributes for images and another 
	table stores style attributes for the text.
    
    A bulleted list of features your application includes
    
    * ability to style content, drag images and text around on the page
    * ability to chose a font for your post using the Google fonts (ajax)
    * ability to import user-specific set of images
    * ability to retrieve images and add them to content
	* ability to resize and remove images 
		> double click on an image to resize it.
		> shift click to remove the image.
    
    
    What aspects of your application are being managed by JavaScript
    
    All styling is being handled using JQuery
    Sizing of the DIV that contains the text is handled by JQuery
    Resizing of images is handled by JQuery
    Removal of images is handled by JQuery
    Widgets I am using include:
    	tablesorter.js
    	JQuery accordion widget
    
    Start by uploading some pictures!     
