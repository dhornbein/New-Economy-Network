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

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background-image: url(<?php echo $feature_img ?>)">
  <div class="r-well text-center">
    <h2 class="r-title ostrich"><?php the_title(); ?></h2>
    <div class="r-meta"><a class="btn" href="<?php echo get_permalink(); ?>">View</a></div>
  </div>
</div>
