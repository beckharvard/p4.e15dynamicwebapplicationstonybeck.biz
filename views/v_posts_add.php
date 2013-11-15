<h2>Editor Canvas</h2>
<form method ='POST' action ='/posts/p_add'>

	


	<!-- the canvas area where user can preview the look of their post-->
	<div id='preview'>
	
		<div id='card-background'>
			<div id='canvas'>
				<div id='message-output'></div>
				<div id='recipient-output'></div>
			</div>
			

		</div>	
		<!-- Buttons -->
		<div id='tools-tray'>	
			<input class="buttons" type='button' id='refresh-btn' value='Clear Canvas'><br>
			<input class="buttons" type='submit' value='Publish Post'><br>
			<?=$moreContent;?><br>
		</div>	  		
	</div>	
</form>