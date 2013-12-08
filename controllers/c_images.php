<?php
class images_controller extends base_controller {
	
    public function __construct() {
        parent::__construct();
        
        
    	$client_files_head = Array(
        //	'../js/validate.js',
        //	'../../js/validate.js',
        //	'../js/validate_posts.js',
        //	'../../js/validate_posts.js',
        	'../js/manage_images.js',
    		'../../css/style_php.css',
    		'../../../css/style_php.css'
    		);
    	$this->template->client_files_head = Utils::load_client_files($client_files_head);
    	
    	$client_files_body = Array(
		//	'../js/validate.js',
		//	'../../js/validate.js',
		//	'../js/validate_posts.js',
		//	'../../js/validate_posts.js',
			'../js/manage_images.js',
			'../../css/style_php.css',
			'../../../css/style_php.css'
    		);
    	$this->template->client_files_body = Utils::load_client_files($client_files_body); 
    	   
        $this->template->title = "Images";
    }
    
     public function index() { 
    	# Set up the View
    	$this->template->content = View::instance('v_images_index');
    	$this->template->content = View::instance('v_posts_images');
    #	$this->template->content->images = View::instance('v_toolsAccordian');	
    	
    	# Build the query to get the image(s)
    	$img = "SELECT *
    			FROM images
    			WHERE user_id = ".$this->user->user_id;
    	
    	# Execute the query to getthe users images. 
    	$_POST['image'] = DB::instance(DB_NAME)->sanitize($img);
    	$images = DB::instance(DB_NAME)->select_rows($img);	
    	
    	# Pass data to the View
    	$this->template->content->images = $images;
    	
    	# Render the View
		echo $this->template;
    	
    }
    
    public function get_images_by_user($user_id) {
    	
    	return $images;	
		
	}
	
	public function images() {
	# Set up the View
    	$this->template->content = View::instance('v_images_image');
	
    	# Build the query to get the image(s)
    	$img = "SELECT *
    			FROM images
    			WHERE user_id = ".$this->user->user_id. "INNER JOIN users ON images.user_id = users.user_id";
    	
    	# Execute the query to getthe users images. 
    	$_POST['image'] = DB::instance(DB_NAME)->sanitize($img);
    	$images = DB::instance(DB_NAME)->select_rows($img);	
    	
    	# Pass data to the View
    	$this->template->content->images = $images;
		
		# Render the View
		echo $this->template;
	}
	
	public function add_image()  {
	
		# Set up the View
    	$this->template->content = View::instance('v_images_add_image');
    	$this->template->content->uploadResults = View::instance('v_images_uploadfile');
    	
    	$user = $this->user->user_id;
		
		# Pass data to the View
 		$this->template->content = View::instance('v_images_add_image');
 		$this->template->content->uploadResults = View::instance('v_images_uploadfile');
 			  	
    	# Render template
		echo $this->template;
    
    
    }
    
    public function p_add_image($post, $imageName)  {
    
    	$this->template->content->uploadResults = 	View::instance('v_images_uploadfile');
    	$this->template->content = 					View::instance('v_images_add_image');
    
    	# More data we want stored with the post
    	$_POST['created']  = Time::now();
    	
    	# Associate this post with this user
		$_POST['user_id'] = $this->user->user_id;
		
		# Use the file name to name the file
		$_POST['image_name'] = $imageName;
		
		$image_user_id = DB::instance(DB_NAME)->insert("images", $_POST);
    
    }
    
    public function uploadfile() {
    
    	# Set up the View
    	# $this->template->content = View::instance('v_posts_uploadfile');
    	
    	# try to figure this out from the ajax class in order to get the image submission to show up
    	$this->template->content = 								View::instance('v_images_p_add_image');
    	$view = new View('v_images_uploadfile');
    	
    	
    	if ($_FILES['file']['error'] == 0)
        {
				$filename = $_FILES["file"]["name"];
				$withoutExt = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
				$allowedExts = array("JPG", "JPEG", "jpg", "jpeg", "gif", "GIF", "png", "PNG");
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if ( in_array($ext, $allowedExts) ) {				
					
	
					Upload::upload($_FILES, "/images/posts_pictures/", $allowedExts , $withoutExt ); 
					
		
					if ($_FILES["file"]["error"] > 0) {
						echo "Error: " . $_FILES["file"]["error"] . "<br>";
					}
					else {
						$imageName = $_FILES["file"]["name"];

						echo "Upload: " . $imageName . "<br>";
						echo "Type: " . $_FILES["file"]["type"] . "<br>";
						echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
						echo "<img src=\"/images/posts_pictures/".$_FILES["file"]["name"]."\"  width=\"200\" height=\"150\" >";
						
						$this->p_add_image($_POST, $imageName);
					}  
				}
				else {
					   echo "That is not an accepted file type. We cna only accept the following: \"JPG\", \"JPEG\", \"jpg\", \"jpeg\", \"gif\", \"GIF\", \"png\", \"PNG\"";
				}
		
				
				echo $view;
		}
		else {
		
			echo $error;
		}
		
	}
    

} # eoc