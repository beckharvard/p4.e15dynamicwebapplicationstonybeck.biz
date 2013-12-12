<h2>Add Content</h2>

<!-- Buttons -->
	<input class="buttons" type='button' id='refresh-btn' value='Clear Canvas'>
	
	<input type='button'class="buttons" id="hide-button" class="buttons ui-state-default ui-corner-all" value='Show/Hide Tools'> 	
	
	<input type='button'class="buttons" id="hide-button" class="buttons ui-state-default ui-corner-all" value='Image Gallery'> 	


	<!-- the canvas area where user can preview the look of their post-->
	<div id='preview'>	
		<div id='canvas-background'>
			<div id='canvas'>
				<form id="save_post" method ='POST' onsubmit="doSubmit()"  action ='/posts/p_add'>
					<div id='post_text_output' class="post_text_output">
						<span class="ui-icon ui-icon-arrow-4 "></span>
						<span class="ui-icon ui-icon-trash "></span>  
						<input id="edgeless_field1" class="edgeless_fields" type='text' name='content' size= "40" maxlength="72" placeholder="Use the tools at right to add your post" >
						<input id="edgeless_field_size" class="edgeless_field_size" type='hidden' name="edgeless_field_size" />
						<input id="fields_chosen_font" type="hidden" name='fields_chosen_font'/>
						<input id="text_color_for_post"	type="hidden" name='text_color_for_post' />
						<input id="post_output_text_location" type="hidden" name='post_output_text_location' />
						<input id="post_background" type="hidden" name='post_background'/>
						<input id="font_size_for_post" type="hidden" name='font_size_for_post' />
						<input id="border_color_for_post" type="hidden" name='border_color_for_post' />
						<input id="image_location" type="hidden" name='image_location' />	
						<input id="publish_post" class="ui-icon ui-icon-circle-plus" type='submit' value='Save'>
							
					</div>

				</form>
			</div>
		</div>	
			
	</div>	

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
						<img src="../images/posts_pictures/<?=$image['image_name'] ?>" alt="<?=$image['image_name'] ?>"  width="97" height="72">
						<a href="../images/posts_pictures/<?=$image['image_name'] ?>" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>		
					</div>
				<?php endforeach; ?>
					<?php else: ?>
				<h2>No Images have been uploaded. Click on <a href='/images/add_image'>Add Images</a>
				to upload images </h2>
			<?php endif; ?>	
		</div>
-->