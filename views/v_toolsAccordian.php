<head>
  <meta charset="utf-8" />
  <title>Tools Accordion</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"> </script>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script src="/js/tools.js"></script>
  <script src="/js/fonts.js"></script>
  <script src="/js/font_ajax.js"></script>

</head>
	<body class="accordion">
		<div class="toggler"> 
			<div id="effect" ui-widget-content ui-corner-all">
				<div id="accordion">
  					<h3 class="tool-header">Add your post text:</h3>
  				<div >
    				<span>
						<input type='text' id='myPost' name='content' maxlength="72" value="<? if(isset($post)) echo $post['content'] = trim($post['content'], " \t\n\r" )?>" required>
    					<span class='error' id='text-output-error'></span>
    				</span>
    				<br>
    				<span>
    					<div> Pick a text color:</div> 
    				    <div class='text-colors' id='red-text'>  </div>
						<div class='text-colors' id='orange-text'>  </div>
						<div class='text-colors' id='green-text'>  </div>
						<div class='text-colors' id='yellow-text'>  </div>
						<div class='text-colors' id='blue-text'>  </div>
						<div class='text-colors' id='white-text'>  </div>
						<div class='text-colors' id='indigo-text'>  </div>
						<div class='text-colors' id='violet-text'>  </div>
						<div class='text-colors' id='black-text'>  </div>
						<div class='text-colors' id='gray-text'>  </div>
					</span>
					<br>
					<span>
					<br>
						<select id="styleFont">
    					</select>
					</span>
					<span><div>Font Size (in canvas):
						<select class="font-size-selector">
  							<option class="content-font-size" id="11" value="11">11</option>
  							<option class="content-font-size" id="12" value="12">12</option>
  							<option class="content-font-size" id="14" value="14">14</option>
  							<option class="content-font-size" id="16" value="16">16</option>
  							<option class="content-font-size" id="18" value="18">18</option>
  							<option class="content-font-size" id="20" value="20">20</option>
  							<option class="content-font-size" id="24" value="24">24</option>
  							<option class="content-font-size" id="28" value="28">28</option>
						</select>
						</div>
					</span>
  				</div>
  				<h3 class="tool-header">Background color:</h3>
  				<div>
  					<span>  	
						<div class='colors' id='red'>  </div>
						<div class='colors' id='orange'>  </div>
						<div class='colors' id='green'>  </div>
						<div class='colors' id='yellow'>  </div>
						<div class='colors' id='blue'>  </div>
						<div class='colors' id='white'>  </div>
						<div class='colors' id='indigo'>  </div>
						<div class='colors' id='violet'>  </div>
						<div class='colors' id='black'>  </div>
						<div class='colors' id='gray'>  </div>
    				</span>
  				</div>

  				<h3 class="tool-header">Border Color</h3>
  				<div>
    				<span>
    					<div> Pick a border color:</div> 
    				    <div class='border-colors' id='red-border'>  </div>
						<div class='border-colors' id='orange-border'>  </div>
						<div class='border-colors' id='green-border'>  </div>
						<div class='border-colors' id='yellow-border'>  </div>
						<div class='border-colors' id='blue-border'>  </div>
						<div class='border-colors' id='white-border'>  </div>
						<div class='border-colors' id='indigo-border'>  </div>
						<div class='border-colors' id='violet-border'>  </div>
						<div class='border-colors' id='black-border'>  </div>
						<div class='border-colors' id='gray-border'>  </div>
					</span>
				</div>
				<h3 class="tool-header">Add Images</h3>
				<div id='imagesDiv'>
    				<span >
						<div id='upload_results'>
						    <form action="/posts/uploadfile" method="post" enctype="multipart/form-data">
								<label for="file">Filename:</label>
								<input type="file" name="file" id="file"><br>
								<input type="submit" name="submit" value="Upload">
							</form>
							<div id='display_results'>
								<?=$uploadResults;?>
								<?php if(isset($error)): ?>
									<div class="error">
										<h4>Upload failed.</h4>
										<p>Image file must be a jpg, gif, or png.</p>
									</div>
								<?php endif;?> 
							</div>
						</div>
					</span>
    					<ul>
      						<li>I want to put a picture here</li>
 							<li>I want to put a picture here</li>
 							<li>I want to put a picture here</li>
						</ul>
  				</div>
			</div>
		</div>
	</div>	
</body>