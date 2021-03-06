<script type="text/javascript">
  WebFont.load({
    google: {
      families: [<?=$post['fields_chosen_font']?>]
    }
  });
</script>
<div id='preview'>	
	<div id='canvas-background' style="background-color: <?=$post['post_background']?>">
		<div id='canvas' style="width: 100%; height: 100%; overflow: visible;">
			<div id='post_text_output' class='post_text_output' style=" width: <?=$post['post_text_output_width']; ?>; <?=$location ?>  border-color: <?=$post['border_color_for_post']; ?>; border-width: <?=$post['border_width_for_post']; ?> ;"> 
				<!-- the next lines have the PHP necessary to style the editable version of the post --->
				<?php echo "<h4 id='edgeless_field1' class='edgeless_fields' type='text' name='content' maxlength='72' "?>
						
					<?php echo "style=\"white-space:nowrap; background-color: " ?>
					<?=$post['post_background']?>
					<?php echo "min-width: "; ?> 
					<?=$post['post_text_output_width']; ?>;
					<?php echo "; color: " ?><?=$post['text_color_for_post']?><?php echo "; font-size: " ?>
					<?=$post['font_size_for_post']?><?php echo "px" ?><?php echo "; font-family: " ?><?=$post['fields_chosen_font']?>
							<?php echo"\";" ?>
					<?php echo "size='"; ?>
					<?=$post['edgeless_field_size']?> 
					<?php echo " ';  >"; ?><?=$post['content']?></h4>			
			</div>	
					<!--- $images for now, though eventually I will to change to use posts_images -->
					<?php if(isset($images)): ?>
						<?php echo "<img src=\""?>
						<?php echo $post['image_location']?> 
						<?php echo "\" alt=\"\""?>
						<?php echo "style=\"" ?>
						<?php echo $post['image_position']?>
						<?php echo $post['image_size']?>
						<?php echo "\"" ?>		
					<?php else: ?>
					<?php endif; ?>		
		</div>
	</div>
</div>
