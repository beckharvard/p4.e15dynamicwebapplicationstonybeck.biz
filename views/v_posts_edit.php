<h2>Edit Content</h2>
<!-- Buttons -->
	<input class="buttons" type='button' id='refresh-btn' value='Clear Canvas'>
	
	<input type='button'class="buttons" id="hide-button" class="buttons ui-state-default ui-corner-all" value='Show/Hide Tools'> 	 	

	<!-- the canvas area where user can preview the look of their post-->
	<div id='preview'>	
	
		<div id='canvas-background' style="background-color: <?=$post['post_background']?>">
			<div id='canvas'>
			
			<form method ='POST' action ='/posts/p_edit/<?=$post['post_id']; ?>'>
			
				<br>
				<div id='post_text_output' class='post_text_output' style="<?=$location ?>  border-color: <?=$post['border_color_for_post']; ?>; width: <?=$post['post_text_output_width']; ?>" >
					<span class="ui-icon ui-icon-arrow-4 "></span>
					<span class="ui-icon ui-icon-trash "></span>  
					<!-- the next lines have the PHP necessary to style the editable version of the post --->
					<?php echo "<input id='edgeless_field1' class='edgeless_fields' type='text' name='content' maxlength='72' "?>
							
							<?php echo "style=\"background-color: " ?>
							<?=$post['post_background']?><?php echo "; color: " ?><?=$post['text_color_for_post']?><?php echo "; font-size: " ?>
							<?=$post['font_size_for_post']?><?php echo "px" ?><?php echo "; font-family: " ?><?=$post['fields_chosen_font']?>
							<?php echo"\";" ?>
							<?php echo "size='"; ?>
							<?=$post['edgeless_field_size']?> 
							<?php echo " ' required/>"; ?>
						
						<input id="edgeless_field_size" class="edgeless_field_size" type='hidden' name="edgeless_field_size" value="<?=$post['edgeless_field_size'] ?>" />
						<input id="fields_chosen_font" type="hidden" name='fields_chosen_font' value="<?=$post['fields_chosen_font'] ?>" />
						<input id="text_color_for_post"	type="hidden" name='text_color_for_post'  value="<?=$post['text_color_for_post'] ?>" />
						<input id="post_output_text_location" type="hidden" name='post_output_text_location' />
						<input id="post_background" type="hidden" name='post_background' value="<?=$post['post_background']; ?>" />
						<input id="font_size_for_post" type="hidden" name='font_size_for_post' value="<?=$post['font_size_for_post']; ?>" />
						<input id="border_color_for_post" type="hidden" name='border_color_for_post' value="<?=$post['border_color_for_post']; ?>"/>
						<input id="post_text_output_width" type="hidden" name='post_text_output_width' value="<?=$post['post_text_output_width']; ?>"/>
						<input id="publish_post" class="ui-icon ui-icon-circle-plus" type='submit' value=''>	
						 
					</div>		
			</form>
	<!-- the tools tray where the user adds content to their post -->	
		<div id='tools-tray'>					
			<?=$moreContent;?><br>
		</div>
<!--
		<div id='image-tray'>
			<?php if(isset($images)): ?>
				<?php foreach( $images as $image ): ?>	
					<div class="draggable_image">		
						<h5 class="ui-widget-header"><?=$image['image_name'] ?></h5>
						<img src="../../images/posts_pictures/<?=$image['image_name'] ?>" alt="<?=$image['image_name'] ?>"  width="200" height="150">
						<a href="../../images/posts_pictures/<?=$image['image_name'] ?>" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>		
					</div>
				<?php endforeach; ?>
					<?php else: ?>
				<h2>No Images have been uploaded. Click on <a href='/images/add_image'>Add Images</a>
				to upload images </h2>
			<?php endif; ?>	
		</div>
-->		