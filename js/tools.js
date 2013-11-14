 $(function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  });
  </script>
  <style>
   .toggler { width: 500px; height: 200px; }
  #button { padding: .5em 1em; text-decoration: none; }
  #effect { width: 240px; height: 135px; padding: 0.4em; position: relative; }
  #effect h3 { margin: 0; padding: 0.4em; text-align: center; }
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
  
  $('.colors').click(function() {

	var color_that_was_clicked = $(this).css('background-color');
	
	console.log(color_that_was_clicked);
	
	$('#canvas').css('background-color', color_that_was_clicked);

});