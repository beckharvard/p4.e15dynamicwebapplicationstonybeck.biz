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
      	} 
      	else if ( selectedEffect === "size" ) {
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
			$("#fields_chosen_font").val($("#edgeless_field1").css("font-family"));
			$("#fields_chosen_font").html($("#edgeless_field1").css("font-family"));
		
			//console.log("the id is " + id);                             
   
	});
});