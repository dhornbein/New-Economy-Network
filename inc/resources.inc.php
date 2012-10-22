<?php 
/**
 * Custom functions that relate to resources post type
 *
 * @package NeN
 * @since NeN 1.0
 */

function nen_get_resource_title( $tag = 'small' , $class = false , $attr = false ){
	$title = explode( ':' , get_the_title() , 2) ;

	if ( isset( $title[1] ) )
	{
		$tag_open = '<' . $tag ;
		$tag_open .= ( ! empty( $class ) ) ? ' class="' . $class . '"' : '' ;
		$tag_open .= ( ! empty( $attr ) ) ? ' ' . trim( $attr ) : '' ;
		$tag_open .= '>' ;

		$tag_close = '</' . $tag . '>' ;

		echo $tag_open . $title[0] . ':' . $tag_close . $title[1] ;
	} else {
		echo $title[0] ;
	}
}

 ?>