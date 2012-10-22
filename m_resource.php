<?php
/**
 * Default module for displaying the custom post type Resources
 *
 * @package NeN
 * @since NeN 1.0
 */
?>


<a id="post-<?php the_ID(); ?>" <?php post_class(); ?> href="<?php echo get_permalink(); ?>">
	<h1 class="r-title"><?php nen_get_resource_title('small','r-subtitle ostrich bold'); ?></h1>
  <div class="r-well">
    <header class="r-header">
				<span class="round secondary label"><i class="icon-asterisk"></i> Resource</span>
				<span class="r-links">
					<button class="round secondary label right icon-info-sign"> Learn More</button>
				</span>
		</header>
    <div class="r-content"><?php the_excerpt(); ?></div>
  </div>
</a>
