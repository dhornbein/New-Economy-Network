<?php
/**
 * Default module for displaying the custom post type Resources
 *
 * @package NeN
 * @since NeN 1.0
 */

if ( has_post_thumbnail() ) : 
	$feature_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'resource-small');
?>
<a id="post-<?php the_ID(); ?>" <?php post_class(); ?> href="<?php echo get_permalink(); ?>" style="background-image: url(<?php echo $feature_img[0] ?>)">
  <div class="r-well c-green-border c-alt">
    <div class="r-meta right"><button class="btn tiny">Learn More</button></div>
    <div class="r-title ostrich"><?php the_title(); ?></div>

<?php else : ?>

<a id="post-<?php the_ID(); ?>" <?php post_class(); ?> href="<?php echo get_permalink(); ?>"><h1><?php nen_get_resource_title(); ?></h1>
  <div class="r-well c-green-border c-alt">
    <div class="r-meta right"><button class="btn tiny">Learn More</button></div>

<?php endif; ?>

    <div class="r-content"><p><?php  the_excerpt(); ?></p></div>
  </div>
</a>
