<?php
/**
 * Default module for displaying the custom post type Resources
 *
 * @package NeN
 * @since NeN 1.0
 */


$excerpt = '';
$excerpt = get_the_excerpt();

?>


	<section>
		<a href="<?php echo get_permalink(); ?>" class="r-stage">
			<h1 class="r-title bold"><?php nen_get_resource_title('small','r-subtitle ostrich'); ?></h1>
		<?php 

		$excerpt = '';
		$excerpt = get_the_excerpt();

		if ( ! empty($excerpt) && $excerpt != '' ) {
		echo '<div class="r-content"><h4>' . get_the_title() . '</h4><p>' . $excerpt . '</p></div>';
		} ?>
		</a>
	</section>
