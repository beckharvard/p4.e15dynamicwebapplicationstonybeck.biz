<head>
  <meta charset="utf-8" />
  <title>Tools Accordion</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   <script>
  $(function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
    $('#myPost').keyup(function() {	
		// see also the .keydown and the .on('input' function and contrast the behavior.
			
		// find out what's in the field i.e. what they have typed.
		var myPost = $(this).val();
		
		//take the text from the field and put it on top of the canvas
		$('#post-text-output').html(myPost);
		
		// And let's make it draggable but NOT contained
		$( '#post-text-output' ).draggable();	
	
		//as text grows, we need to track the length...
		var myPost_how_many_chars = myPost.length;	
		var how_many_left = 72 - myPost_how_many_chars;

		// and give feedback to the user about how many chars left... 
		if (how_many_left == 0) {		
			$('#text-output-error').css('color', 'red');
		}
		else if (how_many_left < 72) {
			$('#text-output-error').css('color', 'orange');		
		}		
		$('#text-output-error').html('You have ' + how_many_left + ' characters left');		

	});
    $('.colors').click(function() {

		var color_that_was_clicked = $(this).css('background-color');
	
		//console.log(color_that_was_clicked);
	
		$('#canvas').css('background-color', color_that_was_clicked);

	});	
	$('.text-colors').click(function() {

		var text_color_clicked = $(this).css('background-color');
	
		console.log(text_color_clicked);
	
		$('#post-text-output').css('color', text_color_clicked);

	});
  });
  </script>

  <style>
  </style>
  <script>
  $(function() {
    // run the currently selected effect
    function runEffect() {
      // get effect type from
      var selectedEffect = $( "#effectTypes" ).val();
 
      // most effect types need no options passed by default
      var options = {};
      // some effects have required parameters
      if ( selectedEffect === "scale" ) {
        options = { percent: 0 };
      } else if ( selectedEffect === "size" ) {
        options = { to: { width: 200, height: 60 } };
      }
 
      // run the effect
      $( "#effect" ).toggle( selectedEffect, options, 500 );
    };
 
    // set effect from select menu value
    $( "#hide-button" ).click(function() {
      runEffect();
      return false;
    });
  });
  
  </script>
</head>
	<body class="accordion">
		<div class="toggler"> 
			<div id="effect" ui-widget-content ui-corner-all">
				<div id="accordion">
  					<h3 class="tool-header">Add your post text:</h3>
  				<div >
    				<span>
						<input type='text' id='myPost' name='content' maxlength="72" required>
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
  				<h3 class="tool-header">Add Images</h3>
				<div id='imagesDiv'>
    				<span >
    					<form action="upload_file.php" method="post" enctype="multipart/form-data">
							<label for="file">Filename:</label>
							<input type="file" name="file" id="file"><br>
							<input type="submit" name="submit" value="Submit">
						</form>
					</span>
    					<ul>
      						<li>List item one</li>
 							<li>List item two</li>
 							<li>List item three</li>
						</ul>
  				</div>
  				<h3 class="tool-header">Section 4</h3>
  				<div>
    				<span>
    					Tool 1
   						Tool 2
    				</span>

				</div>
			</div>
		</div>
	</div>
	
</body>