<?php
/**
 * Default module for displaying the custom post type Resources
 *
 * @package NeN
 * @since NeN 1.0
 */


// FORMAT Handling
$format_icon = array(
	'standard' => 'icon-asterisk',
	'link' => 'icon-link', 
	'image' => 'icon-picture',
	'gallery' => 'icon-picture',
	'quote' => 'icon-eye-open',
	'video' => 'icon-film',
	'audio' => 'icon-volume-up',
	'transcript' => 'icon-pencil',
);

$format = get_post_format();
if ( false === $format )
{
	$format = 'standard';
}

//TAXONOMY handling
$sections = get_the_terms($post->ID, 'section');

$category = array();

if ( $sections ) {
	foreach ($sections as $section) {
		$category[] = $section;
	}
}

$excerpt = '';
$excerpt = get_the_excerpt();


?>

<article id="post-<?php the_ID(); ?>" <?php post_class('r-item three mobile-two column'); ?>>

	<?php get_template_part( 'm_resource', get_post_format() ); ?>
	
	<footer class="r-meta">
		<div class="r-format r-popup-trigger left" data-target="#r-format-<?php echo $post->ID ?>">
			<i class="<?php echo $format_icon[ $format ] ?>"></i>
			<div id="r-format-<?php echo $post->ID ?>" class="r-popup">
				<h2 class="bold collapse">This is a <?php echo $format ?> format</h2>
			</div>
		</div>
		<div class="r-tag r-popup-trigger left" data-target="#r-tag-<?php echo $post->ID ?>">
			<i class="icon-tags"></i>
			<div id="r-tag-<?php echo $post->ID ?>" class="r-popup">
				<h2 class="bold collapse">Tags</h2>
				<ul class="link-list">
					<li class="left radius label"><a href="#">Tag one</a></li>
					<li class="left radius label"><a href="#">Tag example two</a></li>
					<li class="left radius label"><a href="#">This Tag also</a></li>
					<li class="left radius label"><a href="#">More Tag</a></li>
				</ul>
			</div>
		</div>
		<div class="r-cat r-popup-trigger left" data-target="#r-cat-<?php echo $post->ID ?>">
			<i class="icon-folder-close"></i>
			<div id="r-cat-<?php echo $post->ID ?>" class="r-popup">
				<h2 class="bold collapse">Section</h2>
				<ul class="link-list">
					<?php foreach ($category as $cat) {
						echo '<li class="left radius label"><a class="clean" href="' . get_term_link( $cat->slug, $cat->taxonomy ) . '" title="' . sprintf(__("View all post filed under %s", "my_localization_domain"), $cat->name) . '">' . $cat->name . '</a></li>';
					} ?>
				</ul>
			</div>
		</div>
		<div class="r-comments r-popup-trigger left" data-target="#r-comments-<?php echo $post->ID ?>">
			<i class="<?php comments_number( 'icon-comment-alt', 'icon-comment', 'icon-comments' ); ?>"></i>
			<div id="r-comments-<?php echo $post->ID ?>" class="r-popup">
				<h2 class="bold collapse">Comments:</h2>
				<?php comments_number( 'There Are No Comments', 'One Comment', '% Comments' ); ?>
			</div>
		</div>
		<div class="r-links right">
			<a class="clean" href="<?php echo get_permalink(); ?>"><i class="icon-circle-arrow-right"></i> Read More</a>
		</div>
	</footer>
</article>