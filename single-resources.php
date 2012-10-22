<?php
/**
 * The Template for displaying all single posts.
 *
 * @package NeN
 * @since NeN 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php 
				if ( get_post_format() == 'video' ) 
				{
					get_template_part( 'slider' , 'video' );
				}
				?>

				<div class="row">
					<?php nen_content_nav( 'nav-above' ); ?>
					
					<?php get_template_part( 'resource', get_post_format( $post->ID ) ); ?>
					
					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() )
							comments_template( '', true );
					?>
				</div>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>