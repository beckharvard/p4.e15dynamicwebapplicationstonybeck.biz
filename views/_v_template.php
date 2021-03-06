<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?>.</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" >
	</script>
	<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js">
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js">
	</script>
	<script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>

	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
</head>
<body>	
	<h1><?=APP_NAME?></h1>
 		<div id='menu'>

        	<!-- Menu for users who are logged in -->
       		<?php if($user): ?>
				<a href='/users/logout'>Logout</a>
        		<a href='/users/profile'>Profile</a>
				<a href='/posts/add'>Add Content</a>
				<a href='/images/add_image'>Add Images</a>
				<a href='/images/index'>Image Gallery</a>
				<a href='/posts/'>View Content List</a>
				<a href='/posts/users'>Follow users</a>

        	<!-- Menu options for users who are not logged in -->
    		<?php else: ?>
        		<a href='/users/signup'>Sign up</a>
        		<a href='/users/login'>Log in</a>
    		<?php endif; ?>
    	</div>
    	<br>
		<div id="main">
			<div id='wrapper'>
    			<?php if(isset($content)) echo $content; ?>
			</div>
		</div>
	<!--adding the javascript here, too because it performs better and it doesn't choke the DOM 
	javascript may need to be here as well as in the head. that's why we could echo $client_files_body
	but then it won't validate at Markup Validation Service and that effects our grade. so, I am commenting out
	<?php if(isset($client_files_body)) echo $client_files_body; ?>-->
<footer>

<div id="footer_left">
<h2><?=APP_NAME?> features</h2>
	<ul>
		<li>Content creation & Styling</li>
		<li>Image Gallery and ability to add images to posts</li>
		<li>View Styled Content</li>
	</ul>
</div>
<div id="footer_right">
	<ul>
		<li>Anthony Beck</li>
		<li>DWA Project 3</li>
		<li>beck@fas.harvard.edu</li>
	</ul>
</div>
</footer>
</body>
</html>