/* this is mine and I wrote it

$( '.draggable_image' ).mouseup(function() {

	// and we will need the location to which the text was dragged...start with a var for the div
		var p = $( '.draggable_image ui-draggable' );
	// need to also get the position of the containing div, so set a var for that div
		var c = $( '#preview' );
	// set new variables be the positons of those divs
		var position = p.position();
		var container = c.position();
	
	// some math to subtract out the container positions so that we are now geting positon relative to the preview area
		var left_pos = position.left - container.left;
		var top_pos = position.top - container.top;

	// add those to an input field so that we can save it to the db for later use
		$( '.draggable_image' ).html( "position: relative; left: " + left_pos + "px; top: " + top_pos + "px;");
		$( '.draggable_image' ).val( "position: relative; left: " + left_pos + "px; top: " + top_pos + "px;");
	
		console.log("this got called in image manager!");
});

*/

$(function() {
    // there's the gallery and the imagecanvas
    var $gallery = $( "#image-tray" ),
      $imagecanvas = $( "#preview" );
 
    // let the gallery items be draggable
/*    $( "li", $gallery ).draggable({
      cancel: "a.ui-icon", // clicking an icon won't initiate dragging
      revert: "invalid", // when not dropped, the item will revert back to its initial position
      containment: "document",
      helper: "clone",
      cursor: "move"
    });
 */
    // let the imagecanvas be droppable, accepting the gallery items
/*    $imagecanvas.droppable({
      accept: "#gallery > li",
      activeClass: "ui-state-highlight",
      drop: function( event, ui ) {
        deleteImage( ui.draggable );
      }
    });
*/ 
    // let the gallery be droppable as well, accepting items from the imagecanvas
/*    $gallery.droppable({
      accept: "#imagecanvas li",
      activeClass: "custom-state-active",
      drop: function( event, ui ) {
        recycleImage( ui.draggable );
      }
    });
*/ 
    // image deletion function
    var recycle_icon = "<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>";
    function deleteImage( $item ) {
      $item.fadeOut(function() {
        var $list = $( "ul", $imagecanvas ).length ?
          $( "ul", $imagecanvas ) :
          $( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $imagecanvas );
 
        $item.find( "a.ui-icon-trash" ).remove();
        $item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
          $item
            .animate({ width: "48px" })
            .find( "img" )
              .animate({ height: "36px" });
        });
      });
    }
 
    // image recycle function
    var imagecanvas_icon = "<a href='link/to/imagecanvas/script/when/we/have/js/off' title='Delete this image' class='ui-icon ui-icon-trash'>Delete image</a>";
    function recycleImage( $item ) {
      $item.fadeOut(function() {
        $item
          .find( "a.ui-icon-refresh" )
            .remove()
          .end()
          .css( "width", "96px")
          .append( imagecanvas_icon )
          .find( "img" )
            .css( "height", "72px" )
          .end()
          .appendTo( $gallery )
          .fadeIn();
      });
    }
 
    // image preview function, demonstrating the ui.dialog used as a modal window
    function viewLargerImage( $link ) {
      var src = $link.attr( "href" ),
        title = $link.siblings( "img" ).attr( "alt" ),
        $modal = $( "img[src$='" + src + "']" );
 
      if ( $modal.length ) {
        $modal.dialog( "open" );
      } else {
        var img = $( "<img alt='" + title + "' width='384' height='288' style='display: none; padding: 8px;' />" )
          .attr( "src", src ).appendTo( "body" );
        setTimeout(function() {
          img.dialog({
            title: title,
            width: 400,
            modal: true
          });
        }, 1 );
      }
    }
 
    // resolve the icons behavior with event delegation
    $( "ul.gallery > li" ).click(function( event ) {
      var $item = $( this ),
        $target = $( event.target );
 
      if ( $target.is( "a.ui-icon-trash" ) ) {
        deleteImage( $item );
      } else if ( $target.is( "a.ui-icon-zoomin" ) ) {
        viewLargerImage( $target );
      } else if ( $target.is( "a.ui-icon-refresh" ) ) {
        recycleImage( $item );
      }
 
      return false;
    });
  });
