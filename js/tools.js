/*-------------------------------------------------------------------------------------------------
The Tools in the accordion and their style
-------------------------------------------------------------------------------------------------*/
var last_post_length = 0;

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
					
		//as text grows, we need to update the length...
			sizeTextDiv(myPost);
			last_post_length = myPost.length;
			
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
			
		textEntryFieldSize();
		
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
	
	// add the border color that the user has selected
	$('.border-colors').click(function() {
			var border_color_clicked = $(this).css('background-color');
		
			$('#post_text_output').css('border-color', border_color_clicked);
			$('#post_text_output').css('border-style', 'solid;');
			$('#post_text_output').css('border-width', '2px;');
			$('#border_color_for_post').html(border_color_clicked);
			$('#border_color_for_post').val(border_color_clicked);
	});
	
	 $('#border_size').keyup(function() {	
	 		var border_size_entered = $(this).val();	
	 		
	 		$('#post_text_output').css('border-width', border_size_entered);
			$('#border_width_for_post').html(border_size_entered + "px;");
			$('#border_width_for_post').val(border_size_entered + "px;");
	 
	 });
	
	
	// apply the selected font to the text field
	$("#styleFont").change(function() {
	
			console.log(" Font style was changed!");
		
			var new_font = $(this).val();
			
			$('#edgeless_field1').css('font', new_font);
			
			textEntryFieldSize();
			sizeTextDiv();
				
	});
	
	//  Sets the font size and resizes the text field enclosing div when the font size is changed 
	$( ".font-size-selector" ).change(function() {

		// variable for the current font size
			var old_font_size = $('#font_size_for_post').val();
			
		// we have to handle the case where we are using the default css value, which returns NaN
			if ( old_font_size < 1) {
		// the default font size is 11, and that's a pain to get, so, we hardwire to 11 for now	
				old_font_size = 11;
			}
		
  		// set the font size
  			var new_font_size = $(this).val();
  			
  			old_font_size = parseInt( old_font_size);
  			new_font_size = parseInt( new_font_size); 
  			
  		// the new font size is larger		
  			if ( old_font_size < new_font_size ) {
 		// widen the enclosing div #post_text_output		
  				increaseOutputDiv(new_font_size);
  		// set the input fields to store that value and change the rendered font size
  				setCssFontSize(new_font_size);

  			}
  			
  		// the new font size is smaller. Let's decrease the size of the div.
  			else {
  		// make the enclosing div '#post_text_output' more narrow			
  				decreaseOutputDiv(new_font_size);
  		// set the input fields to store that value and change the rendered font size
  				setCssFontSize(new_font_size);
  				
  			}
  		
  		if ( $('#edgeless_field1').outerWidth() >= $('#post_text_output').innerWidth() ) {
  		
  		  		// and size the  enclosing div by some other rules, too.
  				sizeTextDiv();	
  		}
	
	});
		
	function increaseOutputDiv(new_font_size) {
    	
    	// divide the font size by 25 - we want a rational number
    	var multiple = new_font_size / 25;
    	  	
    	// we are going to multiply by 1 plus the rational number above  	
    	var multiplier = 1 + multiple;
    	
    	console.log('multiplier for increase is:' + multiplier);
    	
    	// set our new width to be the existing width times that value (1 + (font size / 40))
    	var new_width =  ($('#post_text_output').width()) * multiplier;
    	
    	
    	console.log("Increase: new width is now " + new_width);
    	
		setNewWidth(new_width);
    
    };
        
    function decreaseOutputDiv(new_font_size) {
    
    	console.log("decrease  called!");
    	
    	// get the contents of the post
    	var the_post = $('#edgeless_field1').val();
    	
    	// set a variable to the length
    	var post_size = the_post.length;
    	
    	// set the size of the text entry field to that variable.
    	$('#edgeless_field1').attr('size', post_size);
    	
    	// divide the font size by 25 - we want a rational number
    	var multiple = new_font_size / 25;
    	  	
    	// we are going to multiply by 1 plus the rational number above  	
    	var multiplier = multiple;
    	
    	console.log('multiplier for decrease is:' + multiplier);
    	
    	// set our new width to be the existing width times that value
    	var new_width =  ($('#post_text_output').width()) * multiplier;
    	
    	console.log("Decrease: new width is now " + new_width);
    	
		setNewWidth(new_width);
    	
    };
    
    function setCssFontSize (new_font_size) {
		  			
  		// save is to a hidden input for later retrieval
			$('#font_size_for_post').html(new_font_size);
			$('#font_size_for_post').val(new_font_size);
		// update the css with this style
			$('#edgeless_field1').css('font-size', new_font_size + "px");
				
	};
	
	function setNewWidth(new_width) {
        // set new width to the css
  			$('#post_text_output').css('width', ( new_width));
  		// add new width to the hidden input field
  			$('#post_text_output_width').val( new_width );
  			$('#post_text_output_width').html( new_width);
    
   // console.log("Final new width is now " + new_width);
    };
    
    function sizeTextDiv() {
    
    
    	// We need the length for use in sizing the div
  			var post_length = 0;
  			if (typeof myPost != "undefined") {
  				var length_of_my_post = $('#edgeless_field1').attr('value');
  				post_length = length_of_my_post.length;
  			
  			}
  			else  {
  				var length_of_content = $('#edgeless_field1').html();
  				post_length = length_of_content.length;
  			
  			}
  			var font_size = $('#edgeless_field1').css('font-size');
  			
  			if(post_length < last_post_length) {
  				
  				return;
  			}
  			
  			font_size = parseInt(font_size); 
  		
  		// only grow the div for small posts with small font sizes.
 		if (post_length < 34 && font_size < 12) {
 		
			return;
  		}

  		// sizing the div we get current widths and increase the width of the outer div
		while  ( $('#edgeless_field1').outerWidth() >= $('#post_text_output').innerWidth() ) {
			var new_width = $('#post_text_output').innerWidth();
			new_width++;
			console.log("width is now " + new_width);
			$('#post_text_output').css('width', ( new_width ));
		}
  		// and we need to add some padding, so we set a variable for the div width now
  			var a_pinch_more = $('#post_text_output').width();
  		
			for (var i=0;i<16;i++) {
				a_pinch_more += 1;
			}
  		// set new width to the css
  			$('#post_text_output').css('width', ( a_pinch_more));
  		// add new width to the hidden input field
  			$('#post_text_output_width').val( a_pinch_more );
  			$('#post_text_output_width').html( a_pinch_more);

    };
    
    function textEntryFieldSize() {
    
    // we want to restrict the size of the text field size, always.
    
    	if ( $('#edgeless_field1').val().length < $('#edgeless_field1').attr('maxlength')) {
    	// get the contents of the post
    		var the_post = $('#edgeless_field1').val();
    	
    	// set a variable to the length
    		var post_size = the_post.length;
    	
    	// set the size of the text entry field to that variable.
    		$('#edgeless_field1').attr('size', post_size);
    		$('#edgeless_field_size').html( post_size);
    		$('#edgeless_field_size').val( post_size);
    	}
    	else {
    		return;
    	}
    };
    
	
	// on mouse up add the location to which the field was moved to a hiddenfield
	$( '#post_text_output' ).mouseup(function() {

		// and we will need the location to which the text was dragged...start with a var for the div
			var p = $( '#post_text_output' );
		// need to also get the position of the containing div, so set a var for that div
			var c = $( '#preview' );
		// set new variables be the positons of those divs
			var position = p.position();
			var container = c.position();
		
		// some math to subtract out the container positions so that we are now geting positon relative to the preview area
			var left_pos = position.left - container.left;
			var top_pos = position.top - container.top;

		// add those to an input field so that we can save it to the db for later use
			$( '#post_output_text_location' ).html( "position: relative; left: " + left_pos + "px; top: " + top_pos + "px;");
			$( '#post_output_text_location' ).val( "position: relative; left: " + left_pos + "px; top: " + top_pos + "px;");
		
  	});
  	
  		// on mouse up add the location to which the field was moved to a hiddenfield
	$( '.draggable_image' ).mouseup(function() {

		// and we will need the location to which the text was dragged...start with a var for the div
			var p = $( '.draggable_image' );
		// need to also get the position of the containing div, so set a var for that div
			var c = $( '#preview' );
		// set new variables be the positons of those divs
			var position = p.position();
			var container = c.position();
		
		// some math to subtract out the container positions so that we are now geting positon relative to the preview area
			var left_pos = position.left - container.left;
			var top_pos = position.top - container.top;
			
			console.log( "Left is: " + left_pos + " top is: " + top_pos);

		// add those to an input field so that we can save it to the db for later use
			$( '#image_position' ).html( "position: relative; left: " + left_pos + "px; top: " + top_pos + "px;");
			$( '#image_position' ).val( "position: relative; left: " + left_pos + "px; top: " + top_pos + "px;");
		
  	});
// need to write this to try and KEEP DRY  	
  	function storeLocationOnCanvas() {
  	
  			
  	};
  		
  	// if we are editing, we populate the text box and make it draggable
    $(window).load(function populateTextBox() {	
		// if we have a post "myPost"
    	if (typeof myPost != "undefined") {
    	// We can grab the text which loaded into the accordion input field
    		var load_my_post = $('#myPost').val();			
    	// and add that to the field on the canvas
    		$('#edgeless_field1').attr("value", load_my_post);				
    	// and then size it	
    		sizeTextDiv(load_my_post);		
    	}
    	else {
    		var load_my_text_contents = $('#edgeless_field1').html();
    		console.log(" load_my_text_contents  is :" + load_my_text_contents );
    		sizeTextDiv(load_my_text_contents);
    	}
    	
    });
  	
  	
	// persist automatically the fonts if they are not edited but I am not confident that it works yet work.
    $(window).load(function () {
    	
    	var saved_font = $('#edgeless_field1').css('font-family');	
    	
    	if ($('#styleFont').val() === saved_font) {
    	
    		$('#styleFont').attr("value", "selected=\"selected\"");
    		console.log("Font Style Loaded and should be default for font selector");
    		console.log($('#styleFont').attr("value", "selected=\"selected\""));
    	}
    	
    });

// get the above working....
    
    
    $(document).ready(function(){
    
    	// we need to grab the position and apply it to the div  	
    	// And let's make it draggable but NOT contained 
		// because we're ok with growing the canvas
		$( '#post_text_output' ).draggable().css( "position", $( '#post_text_output' ).attr('style') );
		$('#post_output_text_location').val($('#post_output_text_location').css('post_output_text_location'));
  	  //	$( '#imagecanvas' ).draggable().css( "position", $( '#imagecanvas' ).attr('style') );
  	  	$('.draggable_image').draggable().css( "position", $( '#imagecanvas' ).attr('style') );

    });  
// this ain't fully working!	    
 	$('#refresh-btn').on("click", function () {
 	
		$('#canvas').css('background-color', "");
		$('#edgeless_field1').css('background-color', "");
		$('#edgeless_field1').html("");
	
	});
	
/*----------------------------------------------------------------------------------------

	Images - adding image onto the canvas and then once the images are on the 
	on the canvas have certain evens that need to be handled.

----------------------------------------------------------------------------------------*/	
	
	$('.user_images').on("click", function () {
	
		// Clone the sticker that was clicked
		var new_canvas_image = $(this).clone();
	
		// A class so we can position images on the
		var save_existing_class = new_canvas_image.attr('class');
		console.log("the class is " +  save_existing_class);
		new_canvas_image.addClass('draggable_image');
		console.log("the class became " + new_canvas_image.attr('class'));
		
		new_canvas_image.removeClass('user_images');
		console.log("the class then became " + new_canvas_image.attr('class'));
		
		//give it a decent position
		$(new_canvas_image).attr('style', 'position: relative; top: 50px; left: 60;');
		
		//new_canvas_image.addClass(save_existing_class);
	
		// inject the new image into the canvas
		$('#canvas').append(new_canvas_image);
	
		// Make it draggable
		new_canvas_image.draggable({containment: '#canvas', opacity:.35});
		
		$('#image_location').html(new_canvas_image.attr('src'));
		$('#image_location').val(new_canvas_image.attr('src'));
		
		alert("You can drag your image around the canvas to place it. Then, double-click on an image to resize it. Shift-click to remove.");
	});
// this was working!now it only works in edit mode?!
	$('.draggable_image').on("dblclick", function () {
		console.log("double clicked!");
		
		var startW = 0;
		var startH = 0;
		
    	$(this).resizable({
			start : function(event,ui) {
				startW = $(this).outerWidth();
				startH = $(this).outerHeight();
			},
			stop : function(event,ui) {
				endW = $('.draggable_image').width();
				endH = $('.draggable_image').height();
				$("#image_size").html("height:" + endH + "px; width:" + endW + "px;");
				$("#image_size").val("height:" + endH + "px; width:" + endW + "px;");
				// set it back to the default state...
				$('.draggable_image').resizable('destroy');
				$('.draggable_image').draggable({containment: '#canvas', opacity:.35});
			}
			
		});
  	});
	
  	$('.draggable_image').click(function(event) {
		if (event.shiftKey) {
			$(this).remove();
			$('#image_location').html("");
			$('#image_location').val("");
		} 
	});

});