<div class="table_container">
	<table id="myTable2" class="tablesorter">
		<caption></caption>
		<thead>
			<tr>
				<td>Creator
				</td>
				<td>Created
				</td>
				<td>Summary
				</td>
				<td>View
				</td>		
		
			</tr>
		</thead>
		<tbody>
		<?php $count = 0; ?>
			<?php foreach($posts as $post): ?>
				<?php if ( $count % 2 > 0 ) {  $even_odd = "even"; } else { $even_odd = "odd"; } ?>	
				<tr class="<?=$even_odd ?>" >	
					<td>
						<?=$post['first_name']?> <?=$post['last_name']?>
					</td>
					<td class="selection" id="page-<?=$post['content']['post_id']?>">
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