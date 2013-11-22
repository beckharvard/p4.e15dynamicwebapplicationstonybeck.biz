<h2>Editor Canvas</h2>

<!-- Buttons -->
	<input class="buttons" type='button' id='refresh-btn' value='Clear Canvas'>
	
	<input type='button'class="buttons" id="hide-button" class="buttons ui-state-default ui-corner-all" value='Tools'> 	

	<!-- the canvas area where user can preview the look of their post-->
	<div id='preview'>	
		<div id='canvas-background'>
			<div id='canvas'>
				<form id="save_post" method ='POST' onsubmit="doSubmit()"  action ='/posts/p_add'>
				<div id='post-text-output' class='post-text-output' >
					<span class="ui-icon ui-icon-arrow-4 "></span>
					<span class="ui-icon ui-icon-trash "></span>  
					<input id="edgeless_field1" class="edgeless_fields" type='text' name='content' maxlength="72" placeholder="" required>
					<input id="field_style_and_location" type="hidden" />
					<input id="publish_post" class="ui-icon ui-icon-circle-plus" type='submit' value=''>		
				</div>			
				</form>
			</div>
		</div>	
	</div>	

	<!-- the tools tray where the user adds content to their post -->	
		<div id='tools-tray'>			
			<?=$moreContent;?><br>
		</div>