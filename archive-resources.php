<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package NeN
 * @since NeN 1.0
 */

get_header(); ?>

			<section id="primary" class="content-area twelve column">
				<div id="content" class="site-content" role="main">
			
				<?php if ( have_posts() ) : ?>
			
					<header class="page-header">
						<div class="row">
							<div class="four column">
								<h1 class="page-title">
									<?php
										if ( is_category() ) {
											printf( __( 'Category Archives: %s', 'nen' ), '<span>' . single_cat_title( '', false ) . '</span>' );
											
										} elseif ( is_tag() ) {
											printf( __( 'Tag Archives: %s', 'nen' ), '<span>' . single_tag_title( '', false ) . '</span>' );
											
										} elseif ( is_author() ) {
											/* Queue the first post, that way we know
											 * what author we're dealing with (if that is the case).
											*/
											the_post();
											printf( __( 'Author Archives: %s', 'nen' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
											/* Since we called the_post() above, we need to
											 * rewind the loop back to the beginning that way
											 * we can run the loop properly, in full.
											 */
											rewind_posts();
											
										} elseif ( is_day() ) {
											printf( __( 'Daily Archives: %s', 'nen' ), '<span>' . get_the_date() . '</span>' );
											
										} elseif ( is_month() ) {
											printf( __( 'Monthly Archives: %s', 'nen' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
											
										} elseif ( is_year() ) {
											printf( __( 'Yearly Archives: %s', 'nen' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
											
										} else {
											_e( 'Resource Library', 'nen' );
											
										}
									?>
								</h1>
							</div>
							<div class="eight column">
								<?php get_search_form() ?>
							</div>
							<?php
								if ( is_category() ) {
									// show an optional category description
									$category_description = category_description();
									if ( ! empty( $category_description ) )
										echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
										
								} elseif ( is_tag() ) {
									// show an optional tag description
									$tag_description = tag_description();
									if ( ! empty( $tag_description ) )
										echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
								}
							?>
						</div>
					</header><!-- .page-header -->
			
					<div class="row full collapse">
						<?php /* Start the Loop */ 

						$colors = array(
							'default' => 'c-green-bkg  c-white',
							'video' => 'c-red-bkg  c-white',
							'link' => 'c-blue-bkg  c-white',
							'quote' => 'c-yellow-bkg  c-white'
						);

						?>
						<?php while ( have_posts() ) : the_post(); 

						$color = '';

						$format = trim( get_post_format( $post->ID ) );

						if ( array_key_exists( $format , $colors ) )
						{
							$color = $colors[ $format ];
						} else {
							$color = $colors[ 'default'];
						}

						?>
				
							<article class="three column mobile-two r-item <?php echo $color; ?>"><?php get_template_part( 'm_resource', get_post_format( $post->ID ) ); ?></article>
				
						<?php endwhile; ?>
				
				
					<?php else : ?>
				
						<?php get_template_part( 'no-results', 'archive' ); ?>
				
					<?php endif; ?>
			
					</div><!-- .row -->
				</div><!-- #content .site-content -->
			</section><!-- #primary .content-area -->

<?php get_footer(); ?>