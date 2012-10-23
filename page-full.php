<?php
/**
 * Template Name: No Sidebar
 *
 * Single page with no sidebar
 *
 * @package NeN
 * @since NeN 1.0
 */

get_header(); ?>

	<div class="row">

		<div id="primary" class="content-area tweleve column">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

	</div>
<?php get_footer(); ?>