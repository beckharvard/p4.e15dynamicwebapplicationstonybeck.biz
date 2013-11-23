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
    $('.colors').click(function() {
		// set a variable that is the color the user clicked
			var color_that_was_clicked = $(this).css('background-color');
		//console.log(color_that_was_clicked);	
			$('#canvas').css('background-color', color_that_was_clicked);
			$('#edgeless_field1').css('background-color', color_that_was_clicked);

	});	
	$('.text-colors').click(function() {
			var text_color_clicked = $(this).css('background-color');
		// console.log(text_color_clicked);
			$('#edgeless_field1').css('color', text_color_clicked);
	});
	$( ".font-selector" ).change(function() {
  		//console.log( "Handler for .change() called." );
  		
  		// We need the length for use in sizing the div
  			var lengthOfmyPost = $('#edgeless_field1').attr('value');
  			var postLength = lengthOfmyPost.length;
		// console.log('postLength is now ' + postLength);
  			var new_font_size = $(this).val();
  		// sizing the div
  		var pto_field_size =  $('#post-text-output');
  
  		console.log("the size of pto is " + pto_field_size.innerHeight() ); 
  		
  			$('#edgeless_field1').css('font-size', new_font_size + "px");
  			$('#post-text-output').css('height', (new_font_size * 5) + "px");
  			$('#post-text-output').css('width', ((postLength) * new_font_size) + "px");
  			$('#edgeless_field1').css('width', ((postLength * new_font_size)  * .75) + "px");
  			if (postLength > 38) {
				$('#post-text-output').css('width', (postLength * 5.1) + "px");		
			}
	});
	$("#fonts").change(function() {
		//console.log( "Handler for .change() called." );
		var new_font = $(this).val();
		$('#edgeless_field1').css('font', new_font);		
	});
});