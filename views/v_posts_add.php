<h2>Editor Canvas</h2>

<!-- Buttons -->
	<input class="buttons" type='button' id='refresh-btn' value='Clear Canvas'>
	
	<input type='button'class="buttons" id="hide-button" class="buttons ui-state-default ui-corner-all" value='Tools'> 	

	<!-- the canvas area where user can preview the look of their post-->
	<div id='preview'>	
		<div id='card-background'>
			<div id='canvas'>
				<form id="foo" method ='POST' action ='/posts/p_add'>
				<div id='post-text-output' class='post-text-output' >
					<!---submissions is currently an empty array. why?-->
					
					<input id="edgeless_field1" class="edgeless_fields" type='text' name='content' maxlength="72" placeholder="" required>
										
				</div>
				<input id="publish_post" class="buttons" type='submit' value='Publish Post'>
				</form>
			</div>
		</div>	
	
	</div>	

	<!-- the tools tray where the user adds content to their post -->	
		<div id='tools-tray'>			
			<?=$moreContent;?><br>
		</div>