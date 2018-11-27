<?php
$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'home'));
if ( have_posts() ) : the_post(); 
	$main_photo = get_field('main_photo');
	$galleries = get_field('galleries');
	$bgClass = '';
	if($main_photo) {
		$bgClass = ' style="background-image:url('.$main_photo['url'].')"';
	}
?>

<?php if($main_photo) { ?>
<div class="bigpic animated"<?php echo $bgClass;?>>
	<img class="loader" src="<?php bloginfo('template_url') ?>/images/loading.gif" alt="" />
	<img class="mainpic" src="<?php echo $main_photo['url'];?>" alt="<?php echo $main_photo['alt'];?>" />

<?php if($galleries) { ?>
	<ul class="galleries">
	<li class="main current">
		<a class="gallery-thumbnail" title="<?php echo $main_photo['url']?>" href="<?php echo $main_photo['url']?>">
			<img src="<?php echo $main_photo['sizes']['thumbnail'];?>" alt="<?php echo $main_photo['title'];?>" />
		</a>
	</li>
	<?php foreach($galleries as $g) { ?>
		<li class="child">
			<a class="gallery-thumbnail" title="<?php echo $g['title']?>" href="<?php echo $g['url']?>">
				<img src="<?php echo $g['sizes']['thumbnail'];?>" alt="<?php echo $g['title'];?>" />
			</a>
		</li>
	<?php } ?>	
	</ul>
<?php } ?>	
</div>
<?php } ?>	

<?php endif;