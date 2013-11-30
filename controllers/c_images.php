<?php
class images_controller extends base_controller {
	
    public function __construct() {
        parent::__construct();
        
    }
    
     public function index() {
    	 # Set up the View
    	
    }
    
    public static function get_images_by_user($user_id) {
		
		# Build the query to get the image(s)
    	$img = "SELECT *
    			FROM images
    			WHERE user_id = ".$this->user->user_id;
    	
    	# Execute the query to getthe users images. 
    	$_POST['image'] = DB::instance(DB_NAME)->sanitize($img);
    	$images = DB::instance(DB_NAME)->select_rows($img);
    	
    	#var_dump($images);
    	
    	return $images;
		
		
	}


} # eoc