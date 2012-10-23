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
										_e( 'Resource Library', 'nen' );
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
			
					<div id="iso-container" class="row full collapse">
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

						

						$categories = wp_get_object_terms($post->ID, 'section');
						
						$cats = array();

						if($categories){
							foreach($categories as $category) {
								$cats[] = $category->slug;
							}
						}

						if ( in_array( 'feature' , $cats ) ) 
						{ 
							$class = 'r-feature six';

							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'resource-feature' );

						} else { 
							$class = 'three'; 
							$image = false;
						}

						?>
							
							<article class="column mobile-two r-item <?php echo $color . ' ' . $class; ?>"<?php if ( $image ) { echo ' style="background-image:url(' . $image[0] . ')"'; } ?>><?php get_template_part( 'm_resource', get_post_format( $post->ID ) ); ?></article>
				
						<?php endwhile; ?>
				
				
					<?php else : ?>
				
						<?php get_template_part( 'no-results', 'archive' ); ?>
				
					<?php endif; ?>
			
					</div><!-- .row -->
				</div><!-- #content .site-content -->
			</section><!-- #primary .content-area -->

<?php get_footer(); ?>