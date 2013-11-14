<h2>Editor Canvas</h2><h3>Maximum post length is 72 characters</h3>
<form method ='POST' action ='/posts/p_add'>
	<div id='tools-tray'>	
			<?=$moreContent;?> 	
	</div>	
	


	<!-- the canvas area where user can preview the look of their post-->
	<div class='preview">
	
		<div class='card-background'>
			<div class='canvas'>
				<div id='message-output'></div>
				<div id='recipient-output'></div>
			</div>
		
		   
		<!-- Buttons -->
		<input class="buttons" type='button' id='refresh-btn' value='Clear Canvas'><input class="buttons" type='submit' value='Publish Post'>
		</div>
	</div>
	
	
</form>