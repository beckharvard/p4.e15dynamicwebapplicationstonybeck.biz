	<div id='preview'>	
	
		<div id='canvas-background' style="background-color: <?=$post['post_background']?>">
			<div id='canvas'>

			
			<form method ='POST' action ='/posts/p_edit/<?=$post['post_id']; ?>'>
			
				<br>
				<div id='post_text_output' class='post_text_output' style="<?=$location ?>  border-color: <?=$post['border_color_for_post']; ?>; width: <?=$post['post_text_output_width']; ?>" >
					<span class="ui-icon ui-icon-arrow-4 "></span>  
					<!-- the next lines have the PHP necessary to style the editable version of the post --->
					<?php echo "<p id='edgeless_field1' class='edgeless_fields' type='text' name='content' maxlength='72' "?>
							
							<?php echo "style=\"background-color: " ?>
							<?=$post['post_background']?><?php echo "; color: " ?><?=$post['text_color_for_post']?><?php echo "; font-size: " ?>
							<?=$post['font_size_for_post']?><?php echo "px" ?><?php echo "; font-family: " ?><?=$post['fields_chosen_font']?>
							<?php echo"\";" ?>
							<?php echo "size='"; ?>
							<?=$post['edgeless_field_size']?> 
							<?php echo " ' >"; ?><?=$post['content']?></p>
						
				
					</div>		
			</form>
			
			<!--- $images for now, I will to change to use posts_images -->
			<?php if(isset($images)): ?>
				<?php echo "<img class=\"draggable_image\" src=\""?>
				<?php echo $post['image_location']?> 
				<?php echo "\" alt=\"\""?>
				<?php echo "style=\"" ?>
				<?php echo $post['image_position']?>
				<?php echo "\"" ?>
				<?php echo  "width=\"97\" height=\"74\">" ?>		
			<?php else: ?>
			<?php endif; ?>	

