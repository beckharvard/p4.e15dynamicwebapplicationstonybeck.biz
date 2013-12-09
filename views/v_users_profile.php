<script type="text/javascript" src="/js/paginate_posts.js"></script>
<?php if(!$user): ?>
	<?php Router::redirect("/users/login");  ?>
<?php else: ?>
	<h2>This is <?=$user->first_name?>'s  profile...</h2>
<?php endif; ?>
<br/>
<?php if($user) echo $user->first_name;?>
<?php echo ' '; ?>
<?php if($user) echo $user->last_name; ?>
<?php echo '<br/>'; ?>
<?php if($user) echo 'email: '.$user->email; ?>
<?php echo '<br/>'; ?>
<?php if($user) 
	$convert_time = $user->created;
	echo 'Member since: ';
	echo date('M d Y', $convert_time); 
?>
<br/>

	<h3>
		<a href='/users/editProfile' >Edit my profile</a>
	</h3>

<br/>
<table id="myTable" class="tablesorter">
	<thead>
		<tr>
		  <th>Content Text</th>
		  <th><strong> Created: </strong></th>
		  <th><strong> Modified: </strong></th>
		  <th>Edit</th>
		</tr>
  	</thead>
  	<tbody>
	<?php foreach($posts as $post): ?>	
		<tr>
			<td class="selection" id="page-<?=$post['content']['post_id']?>"><?=nl2br($post['content'])?> 
			</td>
			<td class="left-align"> 
			
				<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
					<?=Time::display($post['created'])?>
				</time>
			</td>
			<td class="right-align">
			
				<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
					<?=Time::display($post['modified'])?>
				</time>		
			</td>
			<td>
			<a href='/posts/edit/<?=$post['post_id']; ?>' data-prefetch >Edit</a> 
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
	<br/>
	
	<h2> 
		Why not follow someone? <a href='/posts/users'>Other Posters</a>
	</h2>

