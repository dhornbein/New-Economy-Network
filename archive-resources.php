<?php

$mtime = microtime(); 
$mtime = explode(" ",$mtime); 
$mtime = $mtime[1] + $mtime[0]; 
$starttime = $mtime; 

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

					<nav>

						<?php 
						$sections = get_terms( 'section', 'hide_empty=0' ); 
						$count = count($sections);
						if ( $count > 0 ){
						    echo '<ul class="nav-bar">';
						    foreach ( $sections as $term ) {
						      echo '<li><a class="clean" href="' . get_term_link( $term->slug, $term->taxonomy ) . '" title="' . sprintf(__("View all post filed under %s", "my_localization_domain"), $term->name) . '">' . $term->name . '</a></li>';
						       
						    }
						    echo '</ul>';
						}
						?>

					</nav>				

					<?php 

					$post_type = 'resources';
			    $tax = 'section';
			    $posts_per_page = 10;

					foreach ($sections as $section) {
						$args = array(
	              'post_type'         				=> $post_type,
	              "$tax"              				=> $section->slug,
	              'post_status'       				=> 'publish',
	              'posts_per_page'    				=> $posts_per_page,
	              'posts_per_archive_page'    => $posts_per_page
	          );

				    $post_count = 0;
						$section_query = null;
						$section_query = new WP_Query($args);

					?>

					<div class="row full">
						<div class="column">
							<h1><?php echo $section->name ?> </h1>
						</div>
						<?php if ( ! empty( $section->description ) ) : ?>
						<div class="six column end">
							<p><?php echo $section->description ?></p>
						</div>
						<?php endif; ?>
						<hr>

						<?php while ($section_query->have_posts()) : $section_query->the_post(); $post_count++; ?>
							
							<?php get_template_part( 'm_resource', 'wrapper' ); ?>

						<?php endwhile; ?>

						<?php if ( $post_count == $posts_per_page ) : ?>
						<article class="r-item three mobile-two column end">
							<a href="<?php echo get_term_link( $section->slug , $tax ) ?>" class="r-stage text-center">
								<hr class="space">
								<h4>More Resources from <?php echo $section->name ?></h4>
								<h1><i class="icon-plus-sign"></i></h1>
							</a>
						</article>
						<?php endif; ?>
						
					</div>
					<hr class="space">
						
					<?php } #end foreach ?>

				</div><!-- #content .site-content -->
			</section><!-- #primary .content-area -->

<?php get_footer(); 
$mtime = microtime(); 
$mtime = explode(" ",$mtime); 
$mtime = $mtime[1] + $mtime[0]; 
$endtime = $mtime; 
$totaltime = ($endtime - $starttime); 
echo "This page was created in ".$totaltime." seconds"; 
?>