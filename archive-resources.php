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
						$terms = get_terms("section");
						$count = count($terms);
						if ( $count > 0 ){
						    echo '<ul class="nav-bar">';
						    foreach ( $terms as $term ) {
						      echo '<li><a class="clean" href="' . get_term_link( $term->slug, $term->taxonomy ) . '" title="' . sprintf(__("View all post filed under %s", "my_localization_domain"), $term->name) . '">' . $term->name . '</a></li>';
						       
						    }
						    echo '</ul>';
						}
						?>


						<!-- <ul class="nav-bar">
						  <li class="active"><a href="#">Nav Item 1</a></li>
						  <li class="has-flyout">
						    <a href="#">Nav Item 2</a>
						    <a href="#" class="flyout-toggle"><span> </span></a>
						    <ul class="flyout">
						      <li><a href="#">Sub Nav 1</a></li>
						      <li><a href="#">Sub Nav 2</a></li>
						      <li><a href="#">Sub Nav 3</a></li>
						    </ul>
						  </li>
						</ul> -->
					</nav>					

					<?php $sections = get_terms( 'section', 'hide_empty=0' ); 

					$post_type = 'resources';
			    $tax = 'section';

					foreach ($sections as $section) {
						$args = array(
	              'post_type'         => $post_type,
	              "$tax"              => $section->slug,
	              'post_status'       => 'publish',
	              'posts_per_page'    => -1,
	          );

						$section_query = null;
						$section_query = new WP_Query($args);
					?>

					<div class="row full collapse">
						<div class="column">
							<h1><?php echo $section->name ?> </h1>
						</div>
						<div class="six column end">
							<p><?php echo $section->description ?></p>
						</div>
						<hr>

						<?php while ($section_query->have_posts()) : $section_query->the_post(); ?>
							
							<?php get_template_part( 'm_resource', 'wrapper' ); ?>
				
						<?php endwhile; ?>
						
					</div>
					<hr class="space">
						
					<?php } #end foreach ?>

				</div><!-- #content .site-content -->
			</section><!-- #primary .content-area -->

<?php get_footer(); ?>