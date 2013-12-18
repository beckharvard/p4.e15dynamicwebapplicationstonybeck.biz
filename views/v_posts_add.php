<div id="loading_div">Loading...</div>
	<h2>Add Content</h2>

	<!-- Buttons -->
	
		<input class="buttons" type='button' id='refresh-btn' value='Clear Canvas'>
	
		<input type='button'class="buttons" id="hide-button" class="buttons ui-state-default ui-corner-all" value='Show/Hide Tools'> 		

		<!-- the canvas area where user can preview the look of their post-->
		<div id='preview'>	
			<div id='canvas-background'>
				<div id='canvas'>
					<form id="save_post" method ='POST' onsubmit="doSubmit()" action ='/posts/p_add'>
						<input id="publish_post" class="buttons" type='submit' value='Save'>
						<div id='post_text_output' class="post_text_output">
							<span class="ui-icon ui-icon-arrow-4 "></span> 
							<input id="edgeless_field1" class="edgeless_fields" type='text' name='content' size= "49" maxlength="72" placeholder="I am draggble - Use the tools at right to add text to me" >
							<input id="edgeless_field_size" class="edgeless_field_size" type='hidden' name="edgeless_field_size" />
							<input id="fields_chosen_font" type="hidden" name='fields_chosen_font'/>
							<input id="text_color_for_post"	type="hidden" name='text_color_for_post' />
							<input id="post_output_text_location" type="hidden" name='post_output_text_location' />
							<input id="post_background" type="hidden" name='post_background'/>
							<input id="font_size_for_post" type="hidden" name='font_size_for_post' value="11"/>
							<input id="border_color_for_post" type="hidden" name='border_color_for_post' />
							<input id="border_width_for_post" type="hidden" name='border_width_for_post' />						
							<input id="image_location" type="hidden" name='image_location' />	
							<input id="image_position" type="hidden" name='image_position' />
							<input id="image_size" type="hidden" name='image_size' value="height: 79px; width: 94px;" />
						
							
						</div>
					
					</form>
				</div>
			</div>	
			
		</div>	
	
		<!-- the tools tray where the user adds content to their post -->	
			<div id='tools-tray'>			
				<?=$moreContent;?><br>
			</div>

