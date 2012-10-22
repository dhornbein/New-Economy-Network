<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package NeN
 * @since NeN 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'nen' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<div class="top-bar-wrapper contain-to-grid">
		<nav class="top-bar">
			<ul>
				<li class="name">
					<h1>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img alt="NEN" src="<?php echo get_template_directory_uri(); ?>/images/main_logo.png"></a>
					</h1>
				</li>
			</ul>
			<?php $mainNav = array(
				'theme_location'  => 'primary',
				'container'       => false, 
				'menu_class'      => '', 
				'menu_id'         => '',
				'fallback_cb'     => false,
				'walker'          => new nen_walker_top_nav_menu
			); ?>
			<section>
				<?php wp_nav_menu( $mainNav ); ?>
			</section>
		</nav>
	</div>

	<div class="min-nav">
	  <div class="row">
	    <?php wp_nav_menu( array( 'theme_location' => 'mini' ) ); ?> 
	  </div>
	</div>

	<div id="main" class="site-main">