<?php
/**
 * Module for displaying the custom post type Resources format Image
 *
 * @package NeN
 * @since NeN 1.0
 */

if ( has_post_thumbnail() ) : 
	
	$feature_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'resource-small');

	$feature_img = $feature_img[0];

else :

	$images = nen_get_images('resource-small');


	$feature_img = ( $images ) ? $images[0][0] : get_template_directory_uri() . '/images/default.jpg' ;

endif; ?>

	<section>
		<a href="<?php echo get_permalink(); ?>" class="r-stage"<?php echo ' style="background-image:url(' . $feature_img . ')"' ?>>
			<h1 class="r-title bold"><?php nen_get_resource_title('small','r-subtitle ostrich'); ?></h1>
		</a>
		<?php if ( ! empty($excerpt) && $excerpt != '' ) {
		echo '<div class="r-content"><a href="' . get_permalink() . '"><h4>' . get_the_title() . '</h4></a><p>' . $excerpt . '</p></div>';
		} ?>
	</section>
