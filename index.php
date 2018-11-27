<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */
$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'home'));
get_header(); ?>
<?php if ( have_posts() ) : the_post(); ?>
	<?php
		$amenities = get_field('amenities');
		$form_text = get_field('form_text');
		$form_shortcode = get_field('form_shortcode');
		$main_photo = get_field('main_photo');
		$galleries = get_field('galleries');
		$bgClass = '';
		if($main_photo) {
			$bgClass = ' style="background-image:url('.$main_photo['url'].')"';
		}
	?>
	<div class="col-left">
		<?php if($amenities) { ?>
			<h3 class="title3">Amenities</h3>
			<ul class="amenities">
				<?php foreach($amenities as $a) { ?>
					<li>
						<span class="icon"><i class="fa fa-check"></i></span>
						<span class="info"><?php echo $a['information'];?></span>
					</li>
				<?php } ?>	
			</ul>
		<?php } ?>

		<?php /* DISPLAY ON MOBILE */ ?>
		<?php if($main_photo) { ?>
		<div class="mobile-bigpic">
			<?php get_template_part('template-parts/gallery'); ?>
		</div>
		<?php } ?>	

		<div class="form-details clear">
		<?php if($form_text) { ?>
			<div class="form-text"><?php echo $form_text;?></div>
		<?php } ?>
		<?php if($form_shortcode && do_shortcode($form_shortcode)) { ?>
			<div class="theform clear"><?php echo do_shortcode($form_shortcode);?></div>
			<div class="form-bottom clear">Already signed up? <a href="#">CLICK HERE</a></div>
		<?php } ?>
		</div>

	</div>


	<div class="col-right">
		<div class="gallery-frame">
			<div class="inner clear">
				<?php get_template_part('template-parts/gallery'); ?>
			</div>
		</div>
		
	</div>


<?php endif;
get_footer();
