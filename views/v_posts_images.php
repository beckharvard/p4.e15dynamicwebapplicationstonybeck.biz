<div class="ui-widget ui-helper-clearfix">

	  
	<?php foreach( $images as $image ): ?>			
			<h5 class="ui-widget-header"><?=$image['image_name'] ?></h5>
			<img src="posts_pictures/<?=$image['image_name'] ?>" alt="<?=$image['image_name'] ?>"  width="96" height="72">
			<a href="posts_pictures/<?=$image['image_name'] ?>" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>		
	<?php endforeach; ?>

</div>


 

