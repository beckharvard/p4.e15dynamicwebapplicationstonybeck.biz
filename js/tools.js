/*-------------------------------------------------------------------------------------------------
The Tools in the accordion and their style
-------------------------------------------------------------------------------------------------*/
 $(function() {
 
	// add the accordion
    $( "#accordion" ).accordion({
      collapsible: false
    });

    // for the text box, we track what the user types and add it to the field on the canvas
    $('#myPost').keyup(function() {	
		// see also the .keydown and the .on('input' function and contrast the behavior.
					
		// find out what's in the field i.e. what they have typed.
			var myPost = $(this).val();		
		//take the text from the field and put it on top of the canvas
			$('#edgeless_field1').attr("value", myPost);	
		// And let's make it draggable but NOT contained 
		// because we're ok with growing the canvas
			$( '#post_text_output' ).draggable();
					
		//as text grows, we need to update the length...
			sizeTextDiv();
			
		// how many char so far?
		var myPost_how_many_chars = myPost.length;

		//for user feedback, let's track the number of chars so far
			var how_many_left = 72 - myPost_how_many_chars;
		// and give feedback to the user about how many chars left... 
			if (how_many_left == 0) {		
				$('#text-output-error').css('color', 'red');
			}
			else if (how_many_left < 72) {
				$('#text-output-error').css('color', 'orange');		
			}	
		// always display the number of chars...		
			$('#text-output-error').html('You have ' + how_many_left + ' characters left');	
		
	});
	
	// Add the background color that the user clicked to the canvas and to the text field
    $('.colors').click(function() {
		// set a variable that is the color the user clicked
			var color_that_was_clicked = $(this).css('background-color');
		// set the canvas to have the background color that was clicked
			$('#canvas').css('background-color', color_that_was_clicked);
		// 	set the field to also have that background color.
			$('#edgeless_field1').css('background-color', color_that_was_clicked);
		//Add the background color info to the hidden field so that we can save it for later retrieval.
			$("#post_background").html(color_that_was_clicked);
			$("#post_background").val(color_that_was_clicked);		

	});	
	
	// add the text color that the user has selected
	$('.text-colors').click(function() {
			var text_color_clicked = $(this).css('background-color');
		// console.log(text_color_clicked);
			$('#edgeless_field1').css('color', text_color_clicked);
			$('#text_color_for_post').html(text_color_clicked);
			$('#text_color_for_post').val(text_color_clicked);
	});
	
	// apply the selected font to the text field
	$("#fonts").change(function() {
		console.log( "Hey this fonts things was called." );
			var new_font = $(this).val();
			$('#edgeless_field1').css('font', new_font);
				
	});
	
	//  Sets the font size and resizes the text field enclosing div when the font size is changed 
	$( ".font-size-selector" ).change(function() {

  		// set the font size
  			var new_font_size = $(this).val();
  			
  			  		console.log( "Handler for .change() called. font size is now " + new_font_size);
  	
			$('#font_size_for_post').html(new_font_size);
			$('#font_size_for_post').val(new_font_size);
			$('#edgeless_field1').css('font-size', new_font_size + "px");
			
			sizeTextDiv(new_font_size);
	});
	
	// on mouse up add the location to which the field was moved to a hiddenfield
	$( '#post_text_output' ).mouseup(function() {

    		// and we will need the location to which the text was dragged...
			var p = $( '#post_text_output' );
			var position = p.position();
			// console.log( "left: " + position.left + ", top: " + position.top );
			// add it to a input field so that we can save it for later use
			$( '#post_output_text_location' ).html( "position: relative; left: " + position.left + "; top: " + position.top + ";");
			$( '#post_output_text_location' ).val( "position: relative; left: " + position.left + "; top: " + position.top + ";");
  		});
  		
  	    // if we are editing, we populate the text box and make it draggable
    $(window).load(function populateTextBox() {	
    
    	
    	// We can grab the text which loaded into the accordion input field
    		var LoadMyPost = $('#myPost').val();	
    	// and add that to the field on the canvas
    		$('#edgeless_field1').attr("value", LoadMyPost);	
    	// and make it draggable
    		$( '#post_text_output' ).draggable();
    	// and put it where it belongs?
    		var post_pos = $( '#post_text_output' ).val('style');
    		console.log("the css says it should be at: " + post_pos);
    			
    	// size it	
    		sizeTextDiv();

    });
    
    function sizeTextDiv(new_font_size) {
    	// We need the length for use in sizing the div
  			var lengthOfmyPost = $('#edgeless_field1').attr('value');
  			var post_length = lengthOfmyPost.length;
  			
  		console.log("post is " + post_length + " characters long");

  		// sizing the div we get current widths
  			while  ( $('#edgeless_field1').outerWidth() >= $('#post_text_output').innerWidth() ) {
  				var new_width = $('#post_text_output').innerWidth();
  				new_width++;
  				console.log("width is now " + new_width);
  				$('#post_text_output').css('width', ( new_width ));
  			}
  			
  		//for short texts, we don't need or want to do this
  			if (post_length > 30) {	
  				$('#edgeless_field1').attr('size', post_length);	
			}  
    };
    
 	$('#refresh-btn').on("click", function () {

		$('#canvas').css('background-color', "");
		$('#edgeless_field1').css('background-color', "");
		$('#edgeless_field1').html("");
	
	});

});