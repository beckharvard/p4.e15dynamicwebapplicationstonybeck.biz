/*-------------------------------------------------------------------------------------------------
The Tools in the accordion and their style
-------------------------------------------------------------------------------------------------*/
 $(function() {
 
	// add the accordion
    $( "#accordion" ).accordion({
      collapsible: true
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
			$( '#post-text-output' ).draggable();
					
		//as text grows, we need to track the length...
			var myPost_how_many_chars = myPost.length;
		//we need to to size the div
			if (myPost_how_many_chars > 38) {
				$('#post-text-output').css('width', (myPost_how_many_chars * 5.1) + "px");		
			}
		// sizing the text input box too...
			$('#edgeless_field1').css('width', (myPost_how_many_chars * 5) + "px");
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
	
// HEY I DOn'T THIN THIS IS EVEN USED!!! apply the selected font to the text field
	$("#fonts").change(function() {
		console.log( "Hey this fonts things was called." );
			var new_font = $(this).val();
			$('#edgeless_field1').css('font', new_font);
				
	});
	
	//  Sets the font size and resizes the text field enclosing div when the font size is changed 
	$( ".font-size-selector" ).change(function() {
  		//console.log( "Handler for .change() called." );
  		// set the font size
  			var new_font_size = $(this).val();
  	
  		// We need the length for use in sizing the div
  			var lengthOfmyPost = $('#edgeless_field1').attr('value');
  			var postLength = lengthOfmyPost.length;

  		// sizing the div
  			var pto_field_size =  $('#post-text-output');
  
 // HEYEYEYEYEY I want to use innerHeight to better size these beasts And above, too. 
  		console.log("the size of pto is " + pto_field_size.innerHeight() ); 
  		
  			$('#edgeless_field1').css('font-size', new_font_size + "px");
  			$('#post-text-output').css('height', (new_font_size * 5) + "px");
  			$('#post-text-output').css('width', ((postLength) * new_font_size) + "px");
  			$('#edgeless_field1').css('width', ((postLength * new_font_size)  * .75) + "px");
  			if (postLength > 38) {
				$('#post-text-output').css('width', (postLength * 5.1) + "px");		
			}
			$('#font_size_for_post').html(new_font_size);
			$('#font_size_for_post').val(new_font_size);
	});
	
	// on mouse up add the location to which the field was moved to a hiddenfield
	$( '#post-text-output' ).mouseup(function() {

    		// and we will need the location to which the text was dragged...
			var p = $( '#post-text-output' );
			var position = p.position();
			// console.log( "left: " + position.left + ", top: " + position.top );
			// add it to a input field so that we can save it for later use
			$( '#post_output_text_location' ).html( "left: " + position.left + ", top: " + position.top);
			$( '#post_output_text_location' ).val( "left: " + position.left + ", top: " + position.top);
  		});

});