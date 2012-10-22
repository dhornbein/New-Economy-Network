<?php
/**
 * @package NeN
 * @since NeN 1.0
 */

remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );

?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'nen' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	
			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php nen_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'nen' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'nen' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	
		<footer class="entry-meta">
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'nen' ) );
					if ( $categories_list && nen_categorized_blog() ) :
				?>
				<span class="cat-links">
					<?php printf( __( 'Posted in %1$s', 'nen' ), $categories_list ); ?>
				</span>
				<?php endif; // End if categories ?>
	
				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'nen' ) );
					if ( $tags_list ) :
				?>
				<span class="sep"> | </span>
				<span class="tag-links">
					<?php printf( __( 'Tagged %1$s', 'nen' ), $tags_list ); ?>
				</span>
				<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>
	
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="sep"> | </span>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'nen' ), __( '1 Comment', 'nen' ), __( '% Comments', 'nen' ) ); ?></span>
			<?php endif; ?>
	
			<?php edit_post_link( __( 'Edit', 'nen' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
