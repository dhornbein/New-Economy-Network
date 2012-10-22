<?php
/**
 * NeN functions and definitions
 *
 * @package NeN
 * @since NeN 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since NeN 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'nen_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since NeN 1.0
 */
function nen_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * functions to pull videos id from content and create their embed code.
	 */
	require( get_template_directory() . '/inc/videos.php' );

	/**
	 * functions related to displaying resources
	 */
	require( get_template_directory() . '/inc/resources.inc.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on NeN, use a find and replace
	 * to change 'nen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'nen', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Types
	 */
	add_theme_support( 'post-formats', array(
		'link', 
		'image',
		'gallery',
		'quote',
		'video',
		'audio',
		'transcript'
		) );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'nen' ),
		'mini' => __( 'Mini Sticky Menu', 'nen' ),
		'get_involved' => __( 'Get Involved', 'nen' ),
	) );

	class nen_walker_top_nav_menu extends Walker_Nav_Menu {

		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
    {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
  
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) 
		{
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			# adds a class if there is a child element
			if ( $args->has_children ) {
	      $classes[] = 'has-dropdown';
	    }

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';


			if ( $depth == 0 ) 
			{
				// Seperate and wrap the main menu items in a special div
				$title_array = explode(' ', apply_filters( 'the_title', $item->title, $item->ID ), 2 ); 
				$item_title = '<div class="nav-title ostrich bold">' . $title_array[0] . '</div>';
				$item_title .= ( $title_array[1] ) ? '<div class="nav-subtitle ostrich">' . $title_array[1] . '</div>' : '' ;
			} else {
				$item_title = apply_filters( 'the_title', $item->title, $item->ID );
			}

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . $item_title . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}
endif; // nen_setup
add_action( 'after_setup_theme', 'nen_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since NeN 1.0
 */
function nen_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'nen' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Home Page Widgets', 'nen' ),
		'id' => 'home-sidebar',
		'description' => 'Widgets that appear on the home page in the center area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'nen_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function nen_scripts() {

	/**
	 * add WP-LESS support
	 */

	// require dirname(__FILE__).'/wp-less/bootstrap-for-theme.php';
	// $WPLessPlugin -> dispatch( );

	$stylesheets = array(
		nen_foundation => 		array('path' => '/css/framework/foundation.css','deps' => 'normalize'),
		nen_font_awesome => 		array('path' => '/css/framework/font-awesome.css','deps' => 'nen_foundation'),
		nen_base => 					array('path' => '/css/base.css','deps' => 'foundation'),
		nen_layout => 				array('path' => '/css/layout.css','deps' => 'foundation'),
		nen_colors => 				array('path' => '/css/modules/m-colors.css','deps' => 'foundation'),
		nen_resources => 			array('path' => '/css/modules/m-resources.css','deps' => 'foundation'),
		nen_shared => 				array('path' => '/css/modules/m-shared.css','deps' => 'foundation'),
		nen_state => 					array('path' => '/css/state.css','deps' => 'foundation'),
		nen_theme => 					array('path' => '/css/theme.css','deps' => 'foundation'),
		);


	// style sheets
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/framework/normalize.css' );

	foreach ($stylesheets as $ssName => $ssValue)
	{
		wp_enqueue_style( $ssName, get_template_directory_uri() . $ssValue['path'] );
	}

	// scripts
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'nen_foundation', get_template_directory_uri() . '/js/foundation.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'nen_app', get_template_directory_uri() . '/js/app.js', array( 'nen_foundation' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'nen_scripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );


/**
 * Custome Exerpt
 */

function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more($more) {
       global $post;
	return '&hellip;';
	#return '&hellip; <a href="'. get_permalink($post->ID) . '"><small>Read the Rest</small></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 * Image Handling
 */

	/** set thumbnail size for resource images **/
	add_image_size( 'resource-small', 255, 157, true ); 
	add_image_size( 'resource-feature', 510, 314, true ); 

// get all of the images attached to the current post
function nen_get_images($size = 'thumbnail', $mime = 'image') {
	global $post;
	
	$photos = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => $mime, 'order' => 'ASC', 'orderby' => 'menu_order ID') );
	
	$results = false;

	if ($photos) {
		$results = array();
		foreach ($photos as $photo) {
			// get the correct image html for the selected size
			$results[] = wp_get_attachment_image_src($photo->ID, $size);
		}
	}

	return $results;
}

/**
 * Loop Handling
 */

function nen_home_pagesize( $query ) {
    if ( is_post_type_archive( 'resources' ) ) {
        //Display only 1 post for the original blog archive
        $query->query_vars['posts_per_page'] = 50;
        return;
    }
}
add_action('pre_get_posts', 'nen_home_pagesize', 1);