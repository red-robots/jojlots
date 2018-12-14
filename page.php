<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php

			if(isset($_GET["email"])) :

				while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<h2>*Builders & Investors <span class="small">(foreign or domestic)</span>:</h2>
					<?php the_content(); ?>


				</div><!-- .entry-content -->

				


			</article><!-- #post-## -->

				<?php endwhile; // End of the loop.

				$topo = get_field('topographic_map');
				$plats = get_field('plats');
				$wetlands = get_field('wetlands');
				$wetCovenant = get_field('wetland_covenant');
				$convent = get_field('convent');
			else:
				echo '<h2>You must first fill out the form</h2>';
				echo '<a href="'.get_bloginfo('url').'">fill out form</a>';
			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->


<div class="widget-area">
	<?php if(isset($_GET["email"])) : ?>
		<section class="additionals">
			<h2>Topographic Maps</h2>
			<div class="button">
				<a target="_blank" href="<?php echo $topo; ?>">View</a>
			</div>
			<h2>Plats</h2>
			<div class="button">
				<a target="_blank" href="<?php echo $plats; ?>">View</a>
			</div>
			<h2>Wetland Maps</h2>
			<div class="button">
				<a target="_blank" href="<?php echo $wetlands; ?>">View</a>
			</div>
			<!-- <h2>Wetland Covenants</h2>
			<div class="button">
				<a target="_blank" href="<?php echo $wetCovenant; ?>">View</a>
			</div> -->
			<h2>Covenants</h2>
			<div class="button">
				<a target="_blank" href="<?php echo $convent; ?>">View</a>
			</div>
		</section>
	<?php endif; ?>
</div>
<?php
// get_sidebar();
get_footer();
