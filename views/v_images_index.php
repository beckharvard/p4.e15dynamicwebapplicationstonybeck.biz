<?php if(!$user): ?>
	<?php Router::redirect("/users/login");  ?>
<?php else: ?>
	<h2>These are <?=$user->first_name?>'s pictures...click on any image to view larger</h2>
<?php endif; ?>
<div class="image_container">
		<?php foreach( $images as $image ): ?>
			<div class="image_gallery">
				<h5 class="ui-widget-header"><?=$image['image_name'] ?></h5>
					<a href="posts_pictures/<?=$image['image_name'] ?>" title="View larger image" class="ui-icon ui-icon-zoomin">
						<img src="posts_pictures/<?=$image['image_name'] ?>" alt="<?=$image['image_name'] ?>"  width="96" height="72">
					</a>
				<button title="Delete this image" class="ui-icon ui-icon-trash">
			</div>
		<?php endforeach; ?>
		
		
</div>


