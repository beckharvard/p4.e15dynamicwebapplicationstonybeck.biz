<!-- Buttons -->
	<input class="buttons" type='button' id='refresh-btn' value='Clear Canvas'>
	
	<input type='button'class="buttons" id="hide-button" class="buttons ui-state-default ui-corner-all" value='Tools'> 	

	<!-- the canvas area where user can preview the look of their post-->
	<div id='preview'>	
		<div id='canvas-background'>
			<div id='canvas'>
			<form method ='POST' action ='/posts/p_edit/<?=$post['post_id']; ?>'>
			Edit your post
				<br>
				<div id='post-text-output' class='post-text-output' >
					<span class="ui-icon ui-icon-arrow-4 "></span>
					<span class="ui-icon ui-icon-trash "></span>  
					<!-- the next line has to have the PHP right after the "require>" or I get spaces at left in edit post --->
					<input id="edgeless_field1" class="edgeless_fields" type='text' name='content' maxlength="72" required>
						<input id="fields_chosen_font" type="hidden" name='fields_chosen_font'/>
						<input id="text_color_for_post"	type="hidden" name='text_color_for_post' />
						<input id="post_output_text_location" type="hidden" name='post_output_text_location' />
						<input id="post_background" type="hidden" name='post_background'/>
						<input id="font_size_for_post" type="hidden" name='font_size_for_post' />
						<input id="publish_post" class="ui-icon ui-icon-circle-plus" type='submit' value=''>		
					</div>		
			</form>
	<!-- the tools tray where the user adds content to their post -->	
		<div id='tools-tray'>			
			<?=$moreContent;?><br>
		</div>