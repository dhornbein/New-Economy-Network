<?php
/**
 * Default module for displaying the custom post type Resources
 *
 * @package NeN
 * @since NeN 1.0
 */


$videos = nen_get_videos( get_the_content() );

?>


	<section>
		<div class="r-stage-video"><?php echo $videos[0]; ?></div>
	</section>
