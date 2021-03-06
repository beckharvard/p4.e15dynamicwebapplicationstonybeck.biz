<div class="table_container">
	<table id="myTable2" class="tablesorter">
		<caption></caption>
		<thead>
			<tr>
				<th class="header">Creator</th>
				<th class="header">Created</th>
				<th class="header">Summary</th>
				<th class="header">View</th>		
			</tr>
		</thead>
		<tbody>
		<?php $count = 0; ?>
			<?php foreach($posts as $post): ?>
				<?php if ( $count % 2 > 0 ) {  $even_odd = "even"; } else { $even_odd = "odd"; } ?>	
				<tr class="<?=$even_odd ?>" id="page-<?=$post['last_name']?>" >	
					<td class="selection">
						<?=$post['first_name']?> <?=$post['last_name']?>
					</td>
					<td class="selection" id="page-<?=$post['content']?>">
						<?=$post['content']?>
					</td>
					<td>
						<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
							<?=Time::display($post['created'])?>
						</time>
					</td>
					<td><a href='/posts/view/<?=$post['post_id']; ?>' data-prefetch >View</a> 
					</td>
				</tr>
				<?php $count = $count + 1; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
	<h2> Why not follow someone? <a href='/posts/users'>Other Posters</a></h2>
</div> 