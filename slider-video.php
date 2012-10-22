<?php
/**
 * @package NeN
 * @since NeN 1.0
 */

// nen_get_videos fetechs array of videos embed codes

$videos = nen_get_videos( get_the_content() );

if ( $videos ) :
?>

<section class="m-stage">
  <div class="row">
		<?php if ( $videos && count($videos) == 1 ) : ?>
			<div class="twelve centered column loading">
				<?php echo $videos[0]; ?>
			</div>
		<?php elseif ( $videos ): ?>
  		<?php foreach ( $videos as $video_id => $embed ) {
  			echo '<div id="embed_' . $video_id . '">' . $embed . '</div><hr>';
  		} ?>
		<?php endif; ?>
  </div>
</section>
<?php endif; ?>