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

$email = ( isset($_GET['ue']) && $_GET['ue'] ) ? $_GET['ue'] : '';
$time = ( isset($_GET['ts']) && $_GET['ts'] ) ? $_GET['ts'] : '';
$show_private_info = show_private_info($email,$time,300);

$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'home'));
get_header(); 


?>
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
	<h2>*Builders & Investors <span class="small">(foreign or domestic)</span>:</h2>
		<?php the_content(); ?>
		<?php if($amenities) { ?>
			<!-- <h3 class="title3">Amenities</h3>
			<ul class="amenities"> -->
				<?php foreach($amenities as $a) { ?>
					<!-- <li>
						<span class="icon"><i class="fa fa-check"></i></span>
						<span class="info"><?php echo $a['information'];?></span>
					</li> -->
				<?php } ?>	
			<!-- </ul> -->
		<?php } ?>

		<?php /* DISPLAY ON MOBILE */ ?>
		<?php if($main_photo) { ?>
		<div class="mobile-bigpic">
			<?php get_template_part('template-parts/gallery'); ?>
		</div>
		<?php } ?>	

		<?php if($show_private_info) { ?>
			<?php /* PRIVATE DATA */ ?>
			<?php if( $documents = get_field('documents') ) { ?>
			<div class="document-list clear">
				<ul class="documents">
					<?php $j=1; foreach($documents as $doc) { ?>
					<li class="doc<?php echo ($j==1)?' first':'';?>">
						<h4 class="name"><?php echo $doc['doc_title']?></h4>
						<div class="description">
							<?php echo $doc['doc_description']?>
							<?php if($doc['doc_file']) { ?>
							<span class="button"><a href="<?php echo $doc['doc_file']?>" class="btn" target="_blank"><span class="icon"><i class="fa fa-download"></i></span> Download</a></span>
							<?php }  ?>
						</div>
					</li>
					<?php $j++; }  ?>
				</ul>
			</div>
			<?php } ?>

			<?php 
			$other_info1 = get_field('other_info_line1');
			$other_info2 = get_field('other_info_line2');
			$other_info_link = get_field('other_info_link'); 
			if( $other_info1 || $other_info2 ) { ?>
			<div class="the-other-info clear">
				<?php if($other_info1) { ?>
					<h3 class="txt1"><?php echo $other_info1;?></h3>
				<?php }  ?>

				<?php if($other_info1) { ?>
				<p class="txt2"><?php echo $other_info2;?></p>
				<?php }  ?>

				<?php if($other_info_link) { ?>
				<a class="other-link btn" href="<?php echo $other_info_link;?>" target="_blank">CLICK HERE</a>
				<?php }  ?>
				
			</div>
			<?php }  ?>

		<?php } else { ?>

			<?php /* INQUIRY FORM */ ?>
			<div class="form-details clear">
			<?php if($form_text) { ?>
				<div class="form-text"><?php echo $form_text;?></div>
			<?php } ?>
			<?php if($form_shortcode && do_shortcode($form_shortcode)) { ?>
				<div class="theform clear"><?php echo do_shortcode($form_shortcode);?></div>
				<div class="form-bottom clear hide">Already signed up? <a href="#">CLICK HERE</a></div>
			<?php } ?>
			</div>

		<?php } ?>

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
