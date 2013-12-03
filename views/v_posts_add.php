<h2>Editor Canvas</h2>

<!-- Buttons -->
	<input class="buttons" type='button' id='refresh-btn' value='Clear Canvas'>
	
	<input type='button'class="buttons" id="hide-button" class="buttons ui-state-default ui-corner-all" value='Text Tools'> 	
	
	<input type='button'class="buttons" id="hide-button" class="buttons ui-state-default ui-corner-all" value='Image Gallery'> 	


	<!-- the canvas area where user can preview the look of their post-->
	<div id='preview'>	
		<div id='canvas-background'>
			<div id='canvas'>
				<form id="save_post" method ='POST' onsubmit="doSubmit()"  action ='/posts/p_add'>
				<div id='post_text_output' class="post_text_output">
					<span class="ui-icon ui-icon-arrow-4 "></span>
					<span class="ui-icon ui-icon-trash "></span>  
					<input id="edgeless_field1" class="edgeless_fields" type='text' name='content' maxlength="72" placeholder="" >
					<input id="edgeless_field_size" class="edgeless_field_size" type='hidden' name="edgeless_field_size" />
					<input id="fields_chosen_font" type="hidden" name='fields_chosen_font'/>
					<input id="text_color_for_post"	type="hidden" name='text_color_for_post' />
					<input id="post_output_text_location" type="hidden" name='post_output_text_location' />
					<input id="post_background" type="hidden" name='post_background'/>
					<input id="font_size_for_post" type="hidden" name='font_size_for_post' />
					<input id="border_color_for_post" type="hidden" name='border_color_for_post' />
					<input id="publish_post" class="ui-icon ui-icon-circle-plus" type='submit' value=''>
							
				</div>
				<div id="imagecanvas" class="ui-widget-content ui-state-default">
  					<h4 class="ui-widget-header"><span class="ui-icon ui-icon-arrow-4 "></span>Image Canvas</h4>
 			
				</form>
			</div>
		</div>	
	</div>	

	<!-- the tools tray where the user adds content to their post -->	
		<div id='tools-tray'>			
			<?=$moreContent;?><br>
		</div>
		<div id='image-tray'>
			<?=$images;?>
			<?=$imageContent;?>
		
		</div>