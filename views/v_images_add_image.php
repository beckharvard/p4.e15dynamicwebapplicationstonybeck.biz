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


<!-- we should turn this into a form, 
and add the image name to the DB in assocition with the post, 
and then dynamically add the image to the page! 

<form id="save_image" method ='POST' action ='/images/p_add_image'>
	<input id="image_field" class="image_field" type="text" name="image_name" />
	<input id="save_picture" class="save_picture" type='submit' value='Add Picture'>
</form>

<form action="/images/uploadfile" method="post" enctype="multipart/form-data">
	<label for="file">Filename:</label>
	<input type="file" name="file" id="file"><br>
	<input type="submit" name="submit" value="Upload">
</form>

-->