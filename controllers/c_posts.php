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
    		'../../../css/style_php.css',
    		'../../jquery/__jquery.tablesorter/themes/blue/style.css',
    		'../../jquery/__jquery.tablesorter/jquery.tablesorter.js',
    		'../../js/table.js',
    		'../../js/tools.js',
  			'../../js/fonts.js',
  			'../../js/font_ajax.js',
  			'../../js/manage_images.js',
    		);
    	$this->template->client_files_head = Utils::load_client_files($client_files_head);
    	
    	$client_files_body = Array(
		//	'../js/validate.js',
		//	'../../js/validate.js',
		//	'../js/validate_posts.js',
		//	'../../js/validate_posts.js',
    		'../../css/style_php.css',
    		'../../../css/style_php.css',
    		'../../jquery/__jquery.tablesorter/themes/blue/style.css',
    		'../../jquery/__jquery.tablesorter/jquery.tablesorter.js',
    		'../../js/table.js',
  			'../../js/fonts.js',
  			'../../js/font_ajax.js',
  			'../../js/manage_images.js'
    		);
    	$this->template->client_files_body = Utils::load_client_files($client_files_body); 
    	   
    	$this->template->title   = "Posts";
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
    	$this->template->content->moreContent = 				View::instance('v_posts_accordion');   	
    	$this->template->content->imageContent = 				View::instance('v_posts_images');
    	
    	$user = $this->user->user_id;
 
    	# Build the query to get the image(s)
    	$img = "SELECT *
    			FROM images
    			WHERE user_id = ".$this->user->user_id;
    	
    	# Execute the query to getthe users images. 
    	$_POST['image'] = DB::instance(DB_NAME)->sanitize($img);
    	$images = DB::instance(DB_NAME)->select_rows($img);	
		
		# Pass data to the View
    	$this->template->content->images = $images;
    	$this->template->content->moreContent->images = $images;
  
    	# Render template
		echo $this->template;
		
    }
    
	public function p_add()  {
    
    	 //upload an image

    	# Set up the View
    	$this->template->content = View::instance('v_posts_p_add');
    	$this->template->content->moreContent = View::instance('v_posts_accordion');
    	
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
    
    public function view($viewed)  {
    	$this->template->content = View::instance('v_posts_view');
    	$this->template->content->location = View::instance('v_posts_view');
    	$this->template->content->moreContent = View::instance('v_posts_view');
    	$this->template->content->imageContent = View::instance('v_posts_images');
    	
    	# Build the query to get the post
    	$q = "SELECT *
    	    FROM posts
    	    WHERE 
    	    post_id = ".$viewed;
    	
    	# Build the query to get the post's location
    	$position = "SELECT post_output_text_location
    				FROM posts
    				WHERE
    	    		post_id = ".$viewed;
    	    	
    	# Build the query to get the image(s)
    	$img = "SELECT *
    			FROM images
    			WHERE user_id = ".$this->user->user_id;
    	
    	# Execute the query to getthe users images. 
    	$_POST['image'] = DB::instance(DB_NAME)->sanitize($img);
    	$images = DB::instance(DB_NAME)->select_rows($img);	

    	# Execute the query to get the post. 
    	# Store the result array in the variable $post
    	$_POST["editable"] = DB::instance(DB_NAME)->select_row($q);
    	$location = DB::instance(DB_NAME)->select_field($position);
    	
    # these should be put in their proper places once I get Image.php feeding data to the view		
    	$user = $this->user->user_id;
    	
    	# Pass data to the View
    	$this->template->content->images = $images;
    	$this->template->content->moreContent->images = $images;
    	$this->template->content->post = $_POST['editable'];
    	$this->template->content->moreContent->post = $_POST['editable'];
    	$this->template->content->location = $location;
    	
    	# Render template
		echo $this->template;  	 
    }

    public function edit($edited)  {
    	# Set up the View
    	$this->template->content = View::instance('v_posts_edit');
    	$this->template->content->location = View::instance('v_posts_edit');
    	$this->template->content->moreContent = View::instance('v_posts_accordion');
    	$this->template->content->imageContent = View::instance('v_posts_images');
    		
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
    	    	
    	# Build the query to get the image(s)
    	$img = "SELECT *
    			FROM images
    			WHERE user_id = ".$this->user->user_id;
    	
    	# Execute the query to getthe users images. 
    	$_POST['image'] = DB::instance(DB_NAME)->sanitize($img);
    	$images = DB::instance(DB_NAME)->select_rows($img);	

    	# Execute the query to get the post. 
    	# Store the result array in the variable $post
    	$_POST["editable"] = DB::instance(DB_NAME)->select_row($q);
    	$location = DB::instance(DB_NAME)->select_field($position);
    	
    # these should be put in their proper places once I get Image.php feeding data to the view		
    	$user = $this->user->user_id;
    	
    	# Pass data to the View
    	$this->template->content->images = $images;
    	$this->template->content->moreContent->images = $images;
    	$this->template->content->post = $_POST['editable'];
    	$this->template->content->moreContent->post = $_POST['editable'];
    	$this->template->content->location = $location;
    	
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
    