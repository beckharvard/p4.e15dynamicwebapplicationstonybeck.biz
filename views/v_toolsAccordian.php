<head>
  <meta charset="utf-8" />
  <title>Tools Accordion</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"> </script>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />

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
		$('#edgeless_field1').attr("value", myPost);
		
		// And let's make it draggable but NOT contained
		$( '#post-text-output' ).draggable();	
	
		//as text grows, we need to track the length...
		var myPost_how_many_chars = myPost.length;
		
		//we need to to size the text input box too...
		if (myPost_how_many_chars > 38) {
			$('#post-text-output').css('width', (myPost_how_many_chars * 5.1) + "px");		
		}
		$('#edgeless_field1').css('width', (myPost_how_many_chars * 5) + "px");
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
		$('#edgeless_field1').css('background-color', color_that_was_clicked);

	});	
	$('.text-colors').click(function() {

		var text_color_clicked = $(this).css('background-color');
	
		console.log(text_color_clicked);
	
		$('#edgeless_field1').css('color', text_color_clicked);

	});
	$( ".font-selector" ).change(function() {
  		//console.log( "Handler for .change() called." );
  		
  		
  		var lengthOfmyPost = $('#edgeless_field1').attr('value');
  		var postLength = lengthOfmyPost.length;
		console.log('postLength is now ' + postLength);
  		var new_font_size = $(this).val();
  		$('#edgeless_field1').css('font-size', new_font_size + "px");
  		$('#post-text-output').css('height', (new_font_size * 5) + "px");
  		$('#post-text-output').css('width', ((postLength) * new_font_size) + "px");
  		$('#edgeless_field1').css('width', ((postLength * new_font_size)  * .75) + "px");
  				// We need the length for use in sizing the div

	});
	$("#fonts").change(function() {
		console.log( "Handler for .change() called." );
		var new_font = $(this).val();
		$('#edgeless_field1').css('font', new_font);
		
		
	});

  });
</script>
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
    // when a font is picked, style the font to the selected font using ajax
	$("#styleFont").change(function (){
   var id =$('#styleFont option' +':selected').val();  
   $("#edgeless_field1").css('font-family',id);
   console.log("the id is " + id);                             
   
 });
  });
</script>
  
<script>
function SetFonts(fonts) { 
    for (var i = 0; i < fonts.items.length; i++) {      
     $('#styleFont')
         .append($("<option></option>")
         .attr("value", fonts.items[i].family)
         .text(fonts.items[i].family));
    }    
}

$.getJSON("https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyB8Ua6XIfe-gqbkE8P3XL4spd0x8Ft7eWo", function(fonts){
    for (var i = 0; i < fonts.items.length; i++) {      
     $('#styleFont')
         .append($("<option></option>")
         .attr("value", fonts.items[i].family)
         .text(fonts.items[i].family));
    }    
});
var script = document.createElement('script');
script.src = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAYJsif1PxS6-JErAwruv7woKoyMLK7HJA&callback=SetFonts';
document.body.appendChild(script);


 WebFontConfig = {
   google: { families: ['ABeeZee', 'Abel', 'Abril Fatface', 'Aclonica', 'Acme', 'Actor', 'Adamina', 'Advent Pro', 'Aguafina Script', 'Akronim', 'Aladin', 'Aldrich', 'Alegreya', 'Alegreya SC', 'Alex Brush', 'Alfa Slab One', 'Alice', 'Alike', 'Alike Angular', 'Allan', 'Allerta', 'Allerta Stencil', 'Allura', 'Almendra', 'Almendra Display', 'Almendra SC', 'Amarante', 'Amaranth', 'Amatic SC', 'Amethysta', 'Anaheim', 'Andada', 'Andika', 'Angkor', 'Annie Use Your Telescope', 'Anonymous Pro', 'Antic', 'Antic Didone', 'Antic Slab', 'Anton', 'Arapey', 'Arbutus', 'Arbutus Slab', 'Architects Daughter', 'Archivo Black', 'Archivo Narrow', 'Arimo', 'Arizonia', 'Armata', 'Artifika', 'Arvo', 'Asap', 'Asset', 'Astloch', 'Asul', 'Atomic Age', 'Aubrey', 'Audiowide', 'Autour One', 'Average', 'Average Sans', 'Averia Gruesa Libre', 'Averia Libre', 'Averia Sans Libre', 'Averia Serif Libre', 'Bad Script', 'Balthazar', 'Bangers', 'Basic', 'Battambang', 'Baumans', 'Bayon', 'Belgrano', 'Belleza', 'BenchNine', 'Bentham', 'Berkshire Swash', 'Bevan', 'Bigelow Rules', 'Bigshot One', 'Bilbo', 'Bilbo Swash Caps', 'Bitter', 'Black Ops One', 'Bokor', 'Bonbon', 'Boogaloo', 'Bowlby One', 'Bowlby One SC', 'Brawler', 'Bree Serif', 'Bubblegum Sans', 'Bubbler One', 'Buda', 'Buenard', 'Butcherman', 'Butterfly Kids', 'Cabin', 'Cabin Condensed', 'Cabin Sketch', 'Caesar Dressing', 'Cagliostro', 'Calligraffitti', 'Cambo', 'Candal', 'Cantarell', 'Cantata One', 'Cantora One', 'Capriola', 'Cardo', 'Carme', 'Carrois Gothic', 'Carrois Gothic SC', 'Carter One', 'Caudex','Cedarville Cursive', 'Ceviche One', 'Changa One', 'Chango', 'Chau Philomene One', 'Chela One', 'Chelsea Market', 'Chenla', 'Cherry Cream Soda', 'Cherry Swash', 'Chewy', 'Chicle', 'Chivo', 'Cinzel', 'Cinzel Decorative', 'Clicker Script', 'Coda', 'Coda Caption', 'Codystar', 'Combo', 'Comfortaa', 'Coming Soon','Concert One', 'Condiment', 'Content', 'Contrail One', 'Convergence', 'Cookie', 'Copse', 'Corben', 'Courgette', 'Cousine', 'Coustard', 'Covered By Your Grace', 'Crafty Girls', 'Creepster', 'Crete Round', 'Crimson Text', 'Croissant One', 'Crushed', 'Cuprum', 'Cutive', 'Cutive Mono']}
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })();

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
					<br>
					<span>
					<br>
						<select id="styleFont">
    					</select>
					</span>
					<span><div>Font Size (in canvas):
						<select class="font-selector">
  							<option class="content-font-size" id="10" value="10">10</option>
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
  				<h3 class="tool-header">Add Images</h3>
				<div id='imagesDiv'>
    				<span >
    					<form action="/posts/uploadfile" method="post" enctype="multipart/form-data">
							<label for="file">Filename:</label>
							<input type="file" name="file" id="file"><br>
							<input type="submit" name="submit" value="Upload">
						</form>
						<div id='upload_results'>
							<?=$uploadResults;?>
							</div>
					</span>
    					<ul>
      						<li>List item one</li>
 							<li>List item two</li>
 							<li>List item three</li>
						</ul>
  				</div>
  				<h3 class="tool-header">lorem ipsum</h3>
  				<div>
    				<span>    					
    				</span>
				</div>
			</div>
		</div>
	</div>	
</body>