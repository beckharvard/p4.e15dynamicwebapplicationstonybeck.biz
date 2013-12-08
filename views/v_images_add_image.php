<div id='upload_results'>
	<form id="save_image" method ='POST' action ='/images/uploadfile' enctype="multipart/form-data">
		<input type="file" name="file" id="file">
		<input id="image_field" class="image_field" type="hidden" name="image_name"/>
		<input id="save_picture" class="save_picture" type='submit' value="Upload">
	</form>
	<div id='display_results'>
		<?php if(isset($error)): ?>
			<div class="error">
				<h4>Upload failed.</h4>
				<p>Image file must be a jpg, gif, or png.</p>
			</div>
		<?php endif;?> 
	</div>
</div>