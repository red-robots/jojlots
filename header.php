<?php
/**
 * The header for theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>
<?php 
$email = ( isset($_GET['ue']) && $_GET['ue'] ) ? $_GET['ue'] : '';
$time = ( isset($_GET['ts']) && $_GET['ts'] ) ? $_GET['ts'] : '';
$show_private_info = show_private_info($email,$time,300);
if(!$show_private_info && ($email && $time) ) {
	wp_redirect( get_site_url() );
}


wp_head(); 
$logo = get_custom_logo();
$obj = get_queried_object();
$is_home = ( isset($obj->post_name) && $obj->post_name=='home' ) ? true : false;
$classes = ( $is_home ) ? 'home':'subpage';
?>
</head>

<body <?php body_class($classes); ?>>
<div id="page" class="site clear">
	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper">
			<div class="logo">
				<?php if($logo) { ?>
					<?php echo $logo; ?>
				<?php } else { ?>
					<h2 class="logo-name"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h2>
				 <?php } ?>	
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content wrapper">
