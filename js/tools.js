/*-------------------------------------------------------------------------------------------------
	
	The Tools in the accordion are responsible for realtime styling of text and for storing
	those values in hidden fields. When the page is saved (currently by clicking the plus sign 
	the post_output_text div) we save those values off to the database so that they can be retrieved 
	when editing or viewing.

-------------------------------------------------------------------------------------------------*/
var last_post_length = 0;

 $(function() {
 
	// add the accordion
    $( "#accordion" ).accordion({
      collapsible: false
    });

    // for the text box, we track what the user types and add it to the field on the canvas
    $('#myPost').keyup(function() {						
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
		// set the field size so that we don't have a bunch of unused space
			textEntryFieldSize();
		
	});
	
	// Add the background color that the user clicked to the canvas and to the text field
    $('.colors').click(function() {
		// set a variable that is the color the user clicked
			var color_that_was_clicked = $(this).css('background-color');
		// set the canvas css to have the background color that was clicked
			$('#canvas').css('background-color', color_that_was_clicked);
		// 	set the field to also have that background color.
			$('#edgeless_field1').css('background-color', color_that_was_clicked);
		//Add the background color info to the hidden field so that we can save it for later retrieval.
			$("#post_background").html(color_that_was_clicked);
			$("#post_background").val(color_that_was_clicked);		

	});	
	
	// add the text color that the user has selected on the canvas and to the hidden fields
	$('.text-colors').click(function() {
		// set a variable that is the color the user clicked
			var text_color_clicked = $(this).css('background-color');
		// set the text css to have the background color that was clicked
			$('#edgeless_field1').css('color', text_color_clicked);
		//Add the text color info to the hidden field so that we can save it for later retrieval.
			$('#text_color_for_post').html(text_color_clicked);
			$('#text_color_for_post').val(text_color_clicked);
	});
	
	// add the border color that the user has selected on the canvas and to the hidden fields
	$('.border-colors').click(function() {
		// set a variable that is the color the user clicked
			var border_color_clicked = $(this).css('background-color');
		// set the css for the border to have the background color that was clicked
			$('#post_text_output').css('border-color', border_color_clicked);
		// for now the style will always be solid
			$('#post_text_output').css('border-style', 'solid;');
		// to ensure it can be seen, we have the default width of 2 px
			$('#post_text_output').css('border-width', '2px;');
		//Add the border color info to the hidden field so that we can save it for later retrieval.
			$('#border_color_for_post').html(border_color_clicked);
			$('#border_color_for_post').val(border_color_clicked);
	});
	// add the border size to the div on the canvas and to the hidden fields
	 $('#border_size').keyup(function() {	
	 	// set a variable that is the number the user entered
	 		var border_size_entered = $(this).val();	
	 	// set the border css to be that value for the div	
	 		$('#post_text_output').css('border-width', border_size_entered);
	 	//Add the border color info to the hidden field so that we can save it for later retrieval.
			$('#border_width_for_post').html(border_size_entered + "px;");
			$('#border_width_for_post').val(border_size_entered + "px;");
	 
	 });	
	// apply the selected font to the text field
	$("#styleFont").change(function() {
		// this is vestigial. it isn't currently being called
		// but i think i may need it if I cannot get font styling working 
		// on the live server working via ajax 
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
  		// when the div is too small to contain the text entry field call the sizeTextDiv function
  		if ( $('#edgeless_field1').outerWidth() >= $('#post_text_output').innerWidth() ) {  		
  		  		// and size the  enclosing div by some other rules, too.
  				sizeTextDiv();	
  		}	
	});
// the post text is growing, so we need to grow the div		
	function increaseOutputDiv(new_font_size) {   	
    	// divide the font size by 25 - we want a rational number
    		var multiple = new_font_size / 25;   	  	
    	// we are going to multiply by 1 plus the rational number above  	
    		var multiplier = 1 + multiple;   	 	
    	// set our new width to be the existing width times that value (1 + (font size / 40))
    		var new_width =  ($('#post_text_output').width()) * multiplier;
    	// call the setter so that this info is persisted
			setNewWidth(new_width);
    };
// the post text is shrinking, so we need to shrink the div	        
    function decreaseOutputDiv(new_font_size) {	
    	console.log("oh my. decrease was actually called!");
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
    	// set our new width to be the existing width times that value
    		var new_width =  ($('#post_text_output').width()) * multiplier;
    	// call the anonymous function to set the width of the  post_text_output div
			setNewWidth(new_width);    	
    };
    // have to save the CSS for the font size and persist it to the DB
    function setCssFontSize (new_font_size) {		  			
  		// save is to a hidden input for later retrieval on submit
			$('#font_size_for_post').html(new_font_size);
			$('#font_size_for_post').val(new_font_size);
		// update the css with this style
			$('#edgeless_field1').css('font-size', new_font_size + "px");
				
	};
	// the setter for the new width
	function setNewWidth(new_width) {
        // set new width to the css
  			$('#post_text_output').css('width', ( new_width));
  		// add new width to the hidden input field and presumably to the DB on save
  			$('#post_text_output_width').val( new_width );
  			$('#post_text_output_width').html( new_width);
    };
    // figuring out if the text div needs to grow and if so, growing it.
    //this needs to be split up.
    
    function sizeTextDiv() {
    	// We need the length for use in sizing the div
  			var post_length = 0;
  			// the text ID is different when in view mode, needs to be ignore in tables.
  			
  		// since this could be called from a variety of locations we test the argument
  		// in this case  we should have the edgeless_field1 so this presumes edit mode
		if (typeof myPost != "undefined") {
			// we grab that text and store it in a variable 
			var string_of_my_post = $('#edgeless_field1').attr('value');
			// and set a variable with method scope to have the length of that variable
			post_length = string_of_my_post.length;	
			console.log("are we in edit? the post is " + string_of_my_post);
		}
		else  {
			var string_of_content = $('#edgeless_field1').html();
			post_length = string_of_content.length;
			// we know we are called from view and that it doesn't work here. why?
			console.log("why are we here? the post is " + string_of_content);
			console.log("post length is: " + post_length);
		
		}
  			
  		console.log("post length is: " + post_length + " " + "last post length is: " +last_post_length);
  			
		// I think this is stupid and I need to figure out WTF I was doing here and why. 
		// there has to be a better way
		if(post_length < last_post_length) {
			var font_size = $('#edgeless_field1').css('font-size');
			font_size = parseInt(font_size); 
			decreaseOutputDiv(font_size);
		}
		var font_size = $('#edgeless_field1').css('font-size');
		font_size = parseInt(font_size); 
  		
  		// don't grow the div for small posts with small font sizes.
 		if (post_length < 34 && font_size < 12) {
 			console.log("post length was " + post_length + "and font size was " + font_size + " so, return!");
			return;
  		}
  		console.log("edgeless_field1 outerWidth is..."); 
		console.log( $('#edgeless_field1').outerWidth());
		console.log("#post_text_output innerWidth is..."); 
		console.log($('#post_text_output').innerWidth());
		console.log("edgeless_field1 Width is..."); 
		console.log( $('#edgeless_field1').width());
		console.log("#post_text_output Width is..."); 
		console.log($('#post_text_output').width());
		

  		// sizing the div we get current widths and increase the width of the outer div
		while  ( $('#edgeless_field1').outerWidth() >= $('#post_text_output').innerWidth() ) {
			var new_width = $('#post_text_output').innerWidth();
			new_width++;
			console.log("width is now " + new_width);
			$('#post_text_output').css('width', ( new_width ));
		}
  		// and we need to add some padding, so we set a variable for the div width now
  			var a_pinch_more = $('#post_text_output').outerWidth();
  		
			for (var i=0;i<16;i++) {
				a_pinch_more += 1;
			}
  		// set new width to the css
  			$('#post_text_output').css('width', ( a_pinch_more));
  		// add new width to the hidden input field
  			$('#post_text_output_width').val( a_pinch_more );
  			$('#post_text_output_width').html( a_pinch_more);

    };
    // we want to restrict the size to match text field size, always.
    function textEntryFieldSize() {
    	// test for a text string length that is less than the current maxlength attribute
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
			var text_p = $( '#post_text_output' );
		// need to also get the position of the containing div, so set a var for that div
			var text_c = $( '#preview' );
		// set new variables be the positons of those divs
			var position = text_p.position();
			var container = text_c.position();		
		// some math to subtract out the container positions so that we are now geting positon relative to the preview area
			var left_pos = position.left - container.left;
			var top_pos = position.top - container.top;
		// add those to an input field so that we can save it to the db for later use
			$( '#post_output_text_location' ).html( "position: relative; left: " + left_pos + "px; top: " + top_pos + "px;");
			$( '#post_output_text_location' ).val( "position: relative; left: " + left_pos + "px; top: " + top_pos + "px;");		
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
    		console.log("this hapened");
    		var load_my_text_contents = $('#edgeless_field1').html();
    		sizeTextDiv(load_my_text_contents);
    	}
    	
    });
  	
  	$(window).load(function () {
  	
  		$('#loading_div').remove();
  	
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

// get the above working...
    
    $(document).ready(function(){
    // we need to grab the position and apply it to the div  	
    // And let's make it draggable but NOT contained 
	// because we're ok with growing the canvas
		$('#post_text_output' ).draggable().css( "position", $( '#post_text_output' ).attr('style') );
		$('#post_output_text_location').val($('#post_output_text_location').css('post_output_text_location'));
  	  	$('.draggable_image').draggable().css( "position", $( '#imagecanvas' ).attr('style') );
    });  
// this ain't fully working (yet)!	    
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
	//	
		new_canvas_image.addClass('draggable_image');
	//	
		
		new_canvas_image.removeClass('user_images');
	//	console.log("the class then became " + new_canvas_image.attr('class'));
		
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

  	// on mouse up add the location to which the image was moved to a hidden field. need to bind to the body,
	// because the image isn't on the canvas when the page is loaded (or may not be)
	$('body').on('mouseup','.draggable_image', function() {

		// and we will need the location to which the text was dragged...start with a var for the div
			var p = $( '.draggable_image' );
		// need to also get the position of the containing div, so set a var for that div
			var c = $( '#preview' );
		// set new variables be the positons of those divs
			var img_position = p.position();
			var img_container = c.position();
		
		// some math to subtract out the container positions so that we are now geting positon relative to the preview area
			var img_left_pos = img_position.left - img_container.left;
			var img_top_pos = img_position.top - img_container.top;

		// add those to an input field so that we can save it to the db for later use
			$( '#image_position' ).html( "position: relative; left: " + img_left_pos + "px; top: " + img_top_pos + "px;");
			$( '#image_position' ).val( "position: relative; left: " + img_left_pos + "px; top: " + img_top_pos + "px;");
		
  	});	

// this is resizing: need to bind to the body,
// because the image isn't on the canvas when the page is loaded (or may not be)
	$('body').on('dblclick','.draggable_image', function () {
		// start with stock variables
		var startW = 0;
		var startH = 0;
		//set the image to be resizable
    	$(this).resizable({
    		// at the beginning we set the variables for the current width of the image
			start : function(event,ui) {
				startW = $(this).outerWidth();
				startH = $(this).outerHeight();
			},
			// when jquery resize event ends 
			stop : function(event,ui) {
				// store the new width & height
				endW = $('.draggable_image').width();
				endH = $('.draggable_image').height();
				// save those off to hidden fields for later retrieval
				$("#image_size").html("height:" + endH + "px; width:" + endW + "px;");
				$("#image_size").val("height:" + endH + "px; width:" + endW + "px;");
				// set it back to the default state...
				$('.draggable_image').resizable('destroy');
				// go back to the previous draggable state for the image
				$('.draggable_image').draggable({containment: '#canvas', opacity:.35});
			}			
		});
  	});
// we want a way to dismiss the image...when there is a click. need to bind to the body,
// because the image isn't on the canvas when the page is loaded (or may not be)
  	$('body').on('click','.draggable_image', function(event) {
  	// was it a shift-click?
		if (event.shiftKey) {
			$(this).remove();
			// store this removal in the hidden fields 
			$('#image_location').html("");
			$('#image_location').val("");
			$('#image_position').html("");
			$('#image_position').val("");
			$('#image_size').html("");
			$('#image_size').val("");
		} 
	});

});