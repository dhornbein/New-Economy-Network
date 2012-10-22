<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package NeN
 * @since NeN 1.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('panel'); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</div><!-- #post-<?php the_ID(); ?> -->

<?php 
$args = array(
 'post_type' => 'attachment',
 'numberposts' => -1,
 'post_status' => null,
 'post_parent' => $post->ID
);

$attachments = get_posts( $args );
   if ( $attachments ) {
      foreach ( $attachments as $attachment ) {
         echo '<div>' . wp_get_attachment_image( $attachment->ID, 'full' ) . '</div>';
        }
   }
?>
