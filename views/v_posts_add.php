<h2>Editor Canvas</h2>
<!-- Buttons -->
	<input class="buttons" type='button' id='refresh-btn' value='Clear Canvas'>
	<input class="buttons" type='submit' value='Publish Post'>
	<input type='button'class="buttons" id="hide-button" class="buttons ui-state-default ui-corner-all" value='Tools'> 	
<form method ='POST' action ='/posts/p_add'>
	<!-- the canvas area where user can preview the look of their post-->
	<div id='preview'>	
		<div id='card-background'>
			<div id='canvas'>
				<div id='post-text-output' class='post-text-output'></div>
				<div id='image-output1' class='image-output'></div>
				<div id='image-output2' class='image-output'></div>
				<div id='image-output3' class='image-output'></div>
			</div>
		</div>	
	<!-- the tools tray where the user adds content to their post -->	
		<div id='tools-tray'>			
			<?=$moreContent;?><br>
		</div>	  		
	</div>	
</form>