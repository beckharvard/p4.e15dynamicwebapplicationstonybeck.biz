<?php
//for right now I want this for refernce purposes

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