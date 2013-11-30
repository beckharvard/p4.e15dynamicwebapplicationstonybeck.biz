<?php
class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        
        if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
                $client_files_head = Array(
        //	'../js/validate.js',
        //	'../../js/validate.js',
        //	'../js/validate_posts.js',
        //	'../../js/validate_posts.js',
    		'../../css/style_php.css',
    		'../../../css/style_php.css'
    		);
    	$this->template->client_files_head = Utils::load_client_files($client_files_head);
    	
    	$client_files_body = Array(
		//	'../js/validate.js',
		//	'../../js/validate.js',
		//	'../js/validate_posts.js',
		//	'../../js/validate_posts.js',
			'../../css/style_php.css',
			'../../../css/style_php.css'
    		);
    	$this->template->client_files_body = Utils::load_client_files($client_files_body); 
    	   
    } 
    
   public function index() {

    	# Set up the View
    	$this->template->content = View::instance('v_posts_index');
    	
    	$this->template->title   = "Posts";

    	# Build the query
    	$q = 'SELECT
                posts.content,
                posts.created,
                posts.post_id,
                posts.user_id AS post_user_id,
                users_users.user_id AS follower_id,
                users.first_name,
                users.last_name
              FROM posts 
              INNER JOIN users_users
              ON posts.user_id = users_users.user_id_followed
              INNER JOIN users
              ON posts.user_id = users.user_id
              WHERE users_users.user_id = '.$this->user->user_id .' 
              ORDER BY posts.created DESC' ;

    	# Run the query
    	$_POST = DB::instance(DB_NAME)->sanitize($q);
    	$posts = DB::instance(DB_NAME)->select_rows($q);

    	# Pass data to the View
    	$this->template->content->posts = $posts;
    	
    //	var_dump($posts);

    	# Render the View
		echo $this->template;
	}
    
	public function users() {

    	# Set up the View
    	$this->template->content = View::instance("v_posts_users");
    	$this->template->title   = "Users";

    	# Build the query to get all the users
    	$q = "SELECT *
    	    FROM users";

    	# Execute the query to get all the users. 
    	# Store the result array in the variable $users
    	$users = DB::instance(DB_NAME)->select_rows($q);

    	# Build the query to figure out what connections does this user already have? 
    	# I.e. who are they following
    	$q = "SELECT * 
    	    FROM users_users
        	WHERE user_id = ".$this->user->user_id;

    	# Execute this query with the select_array method
    	# select_array will return our results in an array and use the "users_id_followed" field as the index.
    	# This will come in handy when we get to the view
    	# Store our results (an array) in the variable $connections
    	$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

    	# Pass data (users and connections) to the view
    	$this->template->content->users       = $users;
    	$this->template->content->connections = $connections;

    	# Render the view
		echo $this->template;
	}
    
    public function follow($user_id_followed) {

    	# Prepare the data array to be inserted
    	$data = Array(
    	    "created" => Time::now(),
    	    "user_id" => $this->user->user_id,
    	    "user_id_followed" => $user_id_followed
    	    );

    	# Do the insert
    	DB::instance(DB_NAME)->insert('users_users', $data);

    	# Send them back
    	Router::redirect("/posts/users");

	}

	public function unfollow($user_id_followed) {

    	# Delete this connection
    	$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
    	DB::instance(DB_NAME)->delete('users_users', $where_condition);

    	# Send them back
    	Router::redirect("/posts/users");
	}
    
    public function add()  {
	 	# Set up the View
    	$this->template->content = 								View::instance('v_posts_add');
    	$this->template->content->moreContent = 				View::instance('v_toolsAccordian');
    	$this->template->content->imageContent = 				View::instance('v_toolsImage');
    	$this->template->content->images = 						View::instance('v_toolsImage');
    	$this->template->content->moreContent->uploadResults = 	View::instance('v_posts_uploadfile');
    	
    	$user = $this->user->user_id;
    	
		$images = Image::get_images_by_user($user);
		
		# var_dump($images);
		
		# Pass data to the View
    	$this->template->content->images = $images;
    	
    	# Render template
		echo $this->template;
		
    }
    
    public function p_add()  {
    
    	 //upload an image

    	# Set up the View
    	$this->template->content = View::instance('v_posts_p_add');
    	$this->template->content->moreContent = View::instance('v_toolsAccordian');
    	$this->template->content->moreContent->uploadResults = View::instance('v_posts_uploadfile');
    	
    	# More data we want stored with the post
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();
    	
    	# Associate this post with this user
		$_POST['user_id'] = $this->user->user_id;
		
		# To protect against xss we remove HTMl special characters, strip tags and slashes
		$_POST["content"] = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');
		$_POST["content"] = strip_tags($_POST["content"]);

    	$author_user_id = DB::instance(DB_NAME)->insert("posts", $_POST);
    	
    	# Send them back
       	Router::redirect('/users/profile');    	
    }
    
    public function add_image()  {
    
    
    }
    
    public function p_add_image()  {
    
    	# More data we want stored with the post
    	$_POST['created']  = Time::now();
    	
    	# Associate this post with this user
		$_POST['user_id'] = $this->user->user_id;
		
		$image_user_id = DB::instance(DB_NAME)->insert("images", $_POST);
    
    }
    
    public function uploadfile() {
    
    	# Set up the View
    	# $this->template->content = View::instance('v_posts_uploadfile');
    	
    	# try to figure this out from the ajax class in order to get the image submission to show up
    	$view = new View('v_posts_uploadfile');
    	
    	
    	if ($_FILES['file']['error'] == 0)
        {
				$filename = $_FILES["file"]["name"];
				$withoutExt = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
				$allowedExts = array("JPG", "JPEG", "jpg", "jpeg", "gif", "GIF", "png", "PNG");
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if ( in_array($ext, $allowedExts) ) {				
					
	
					Upload::upload($_FILES, "/uploads/posts_pictures/", $allowedExts , $withoutExt ); 
		
					if ($_FILES["file"]["error"] > 0) {
						echo "Error: " . $_FILES["file"]["error"] . "<br>";
					}
					else {
						$imageName = $_FILES["file"]["name"];
						
						echo "Upload: " . $_FILES["file"]["name"] . "<br>";
						echo "Type: " . $_FILES["file"]["type"] . "<br>";
						echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
						echo "<img src=\"/uploads/posts_pictures/".$_FILES["file"]["name"]."\">";
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
    
    public function edit($edited)  {
    	# Set up the View
    	$this->template->content = View::instance('v_posts_edit');
    	$this->template->content->location = View::instance('v_posts_edit');
    	$this->template->content->moreContent = View::instance('v_toolsAccordian');
    	$this->template->content->imageContent = View::instance('v_toolsImage');
    	$this->template->content->moreContent->uploadResults = View::instance('v_posts_uploadfile');
    		
    	# Build the query to get the post
    	$q = "SELECT *
    	    FROM posts 
    	    WHERE user_id = ".$this->user->user_id. " AND 
    	    post_id = ".$edited;
    	
    	# Build the query to get the post's location
    	$position = "SELECT post_output_text_location
    				FROM posts
    				WHERE user_id = ".$this->user->user_id. " AND 
    	    		post_id = ".$edited;
    	    	
    # pretty sure I won't need this once I get Image.php feeding data to the view	
    	# Build the query to get the users image(s)
    	#$img = "SELECT image_name
    	#		FROM images
    	#		WHERE user_id = ".$this->user->user_id;

    	# Execute the query to get the post. 
    	# Store the result array in the variable $post
    	$_POST["editable"] = DB::instance(DB_NAME)->select_row($q);
    	$_POST["location"] = DB::instance(DB_NAME)->select_row($position);
    	
    # pretty sure I won't need this once I get Image.php feeding data to the view	
    	#$_POST['image']    = DB::instance(DB_NAME)->select_row($img);
    	
    # these should be put in their proper places once I get Image.php feeding data to the view		
    	$user = $this->user->user_id;
    	
		$this->template->content->images = Image::get_images_by_user($user);
    	

    	
    	
    	print_r($_POST["location"]);
    	
    	# Pass data to the view
    	$this->template->content->post = $_POST['editable'];
    	$this->template->content->moreContent->post = $_POST['editable'];
    	$this->template->content->imageContent = $_POST['image'];
    	$this->template->content->location = $_POST["location"];
    	
    	# Render template
		echo $this->template;  	 
    }
    
    public function p_edit($id)  {
    
    	# Set up the View
    	$this->template->content = View::instance('v_posts_p_edit');
  		
  		# Set the modified time  
    	$_POST['modified'] = Time::now();
    	
    	# Be sure to Associate this post with this user
		$_POST['user_id']  = $this->user->user_id;  
		
		# To protect against xss we remove HTMl special characters, strip tags and slashes
		$_POST["content"] = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');	
		$_POST["content"] = strip_tags($_POST["content"]);
		#$_POST["content"] = stripslashes($_POST["content"]);
         
		# set up the where conditon and update the post.        
		$where_condition = 'WHERE post_id = '.$id;   
		$updated_post = DB::instance(DB_NAME)->update('posts', $_POST, $where_condition);

		# Send them back
       	Router::redirect('/users/profile');
    }
	  
} # eoc
    