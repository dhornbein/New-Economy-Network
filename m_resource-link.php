<?php
/**
 * Default module for displaying the custom post type Resources
 *
 * @package NeN
 * @since NeN 1.0
 */
?>


<header class="r-header">
		<span class="round secondary label"><i class="icon-link"></i> Link</span>
		<span class="r-links">
			<a class="right icon-info-sign" href="<?php echo get_permalink(); ?>"></a>
			<a class="right icon-external-link" href="<?php echo get_permalink(); ?>"></a>
		</span>
</header>
<a id="post-<?php the_ID(); ?>" <?php post_class(); ?> href="<?php echo get_permalink(); ?>">
	<h1 class="r-title"><?php nen_get_resource_title('small','r-subtitle ostrich bold'); ?></h1>
</a>
