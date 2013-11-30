<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Images photo manager</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="/js/manage_images.js"></script>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  
</head>
<body>
 	<div class="ui-widget ui-helper-clearfix">
 
		<ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix">
		  <li class="ui-widget-content ui-corner-tr">
			<h5 class="ui-widget-header">High Tatras</h5>
			<img src="images/high_tatras_min.jpg" alt="The peaks of High Tatras" width="96" height="72">
			<a href="images/high_tatras.jpg" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
			<a href="link/to/trash/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>
		  </li>
		  <li class="ui-widget-content ui-corner-tr">
			<h5 class="ui-widget-header">High Tatras 2</h5>
			<img src="images/high_tatras2_min.jpg" alt="The chalet at the Green mountain lake" width="96" height="72">
			<a href="images/high_tatras2.jpg" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
			<a href="link/to/trash/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>
		  </li>
		  <li class="ui-widget-content ui-corner-tr">
			<h5 class="ui-widget-header">High Tatras 3</h5>
			<img src="images/high_tatras3_min.jpg" alt="Planning the ascent" width="96" height="72">
			<a href="images/high_tatras3.jpg" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
			<a href="link/to/trash/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>
		  </li>
		  <li class="ui-widget-content ui-corner-tr">
			<h5 class="ui-widget-header">High Tatras 4</h5>
			<img src="images/high_tatras4_min.jpg" alt="On top of Kozi kopka" width="96" height="72">
			<a href="images/high_tatras4.jpg" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
			<a href="link/to/trash/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>
		  </li>
		  
	<!--	  	<?php foreach($images as $image ): ?>
				<li>
					<h5 class="ui-widget-header"><?=$image['image_name'] ?></h5>
					<img src="images/<?=$image['image_name'] ?>" alt="<?=$image['image_name'] ?>"  width="96" height="72">
					<a href="images/<?=$image['image_name'] ?>" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
					<a href="link/to/trash/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>
	
				</li>
			<?php endforeach; ?>
		</ul>
		
	-->
 
	</div>


 
 
</body>
</html>