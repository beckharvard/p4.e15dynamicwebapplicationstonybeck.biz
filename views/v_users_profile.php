<!-- This is a plug in I am using for the tables-->
<script>
$(document).ready(function() 
    {       
        $("#myTable").tablesorter({ widgets: ['zebra'] }); 
    } 
); 
</script>
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
	<caption></caption>
	<thead>
		<tr>
		  <th class="header" >Content Text</th>
		  <th class="header" ><strong> Created: </strong></th>
		  <th class="header" ><strong> Modified: </strong></th>
		  <th class="header" >Edit</th>
		</tr>
  	</thead>
  	<tbody>
  	<?php $count = 0; ?>
	<?php foreach($posts as $post): ?>	
		<?php if ( $count % 2 > 0 ) {  $even_odd = "even"; } else { $even_odd = "odd"; } ?>	
		<tr class="<?=$even_odd ?>" >	
			<td class="selection" id="page-<?=$post['content']?>"><?=nl2br($post['content'])?> 
			</td>
			<td class="left-align"> 		
				<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
					<?=Time::display($post['created'])?>
				</time>
			</td>
			<td class="left-align">
				<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
					<?=Time::display($post['modified'])?>
				</time>		
			</td>
			<td>
			<a href='/posts/edit/<?=$post['post_id']; ?>' data-prefetch >Edit</a> 
			</td>
		</tr>
		<?php $count = $count + 1; ?>
	<?php endforeach; ?>
	</tbody>
</table>
	<br/>
	
	<h2> 
		Why not follow someone? <a href='/posts/users'>Other Posters</a>
	</h2>

