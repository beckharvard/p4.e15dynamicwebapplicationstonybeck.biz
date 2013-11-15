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
    $('.colors').click(function() {

		var color_that_was_clicked = $(this).css('background-color');
	
		console.log(color_that_was_clicked);
	
		$('#canvas').css('background-color', color_that_was_clicked);

	});
  });
  </script>

  <style>
   .toggler { width: 200px; height: 200px; }
  #button { padding: .5em 1em; text-decoration: none; }
  #effect { width: 260px; height: 135px; padding: 0.4em;  }
  #effect h3 { margin: 0; padding: 0.4em; text-align: center; font-size: 12px;}
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
						<textarea id='myPost' cols='15' rows='5' type='text' name='content' maxlength="72" required></textarea>
    				</span>
    				<h3>Maximum post length is 72 characters</h3>
  				</div>
  				<h3 class="tool-header">Background color:</h3>
  				<div>
  					<span>  	
						<div class='colors' id='red'>  </div>
						<div class='colors' id='orange'>  </div>
						<div class='colors' id='green'>  </div>
						<div class='colors' id='yellow'>  </div>
						<div class='colors' id='blue'>  </div>
						<div class='colors' id='indigo'>  </div>
						<div class='colors' id='violet'>  </div>
						<div class='colors' id='black'>  </div>
						<div class='colors' id='gray'>  </div>
    				</span>
  				</div>
  				<h3 class="tool-header">Add Images</h3>
				<div>
    				<span>
    					<input type=file></input>
   						Tool 2
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
	<input type='button'class="buttons" id="hide-button" class="buttons ui-state-default ui-corner-all" value='Tools'> 
</body>