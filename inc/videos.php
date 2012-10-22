<?php
/**
 * Custom functions for parsing content, pulling video links, finding ID, and building embed code
 *
 * @package NeN
 * @since NeN 1.0
 */


/**
 * Parses a URL and returns the correct video ID based on service.
 * 
 * @param  string $content     the content to parse
 * @param  string $service 'youtube', 'vimeo' etc.
 * 
 * @return string
 */

function nen_get_videos( $content ) {
	return nen_embed_video( nen_find_video_link_id( $content ) );
}

function nen_find_video_link_id( $content ) {
	$video_id = array();

	// supported services
	$services = array(
	'youtube' => '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
	'vimeo' => '/vimeo\.com\/([^&]*)/i',
	'pbs' => '/pbs\.org\/video\/([^&]*)/i'
	);

	foreach ($services as $service => $regex) {
		if (preg_match_all($regex, $content, $match)) {
			$video_id[$service] = $match[1];
		}
	}

	return ( ! empty($video_id) ) ? $video_id : false ;
}

function nen_embed_video( $videos )
{
	if( ! $videos ) { return false; }

	$out = array();
	foreach ($videos as $service => $ids) {
		foreach ($ids as $id) {
			switch ($service) {
				case 'youtube':

					$out[] = nen_youtube_embed( $id );
					break;

				case 'vimeo':
					$out[] = nen_vimeo_embed( $id );
					break;

				case 'pbs':
					$out[] = nen_pbs_embed( $id );
					break;
			}
		}
	}

	return ( ! empty($out) ) ? $out : false ;
}

function nen_youtube_embed( $id ) {
	return '<iframe class="video-embed video-youtube" style="width:100%;" src="https://www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe>';
}

function nen_vimeo_embed( $id ) {
	return '<iframe class="video-embed video-vimeo" style="width:100%;" src="http://player.vimeo.com/video/' . $id . '?title=false&color=41B549" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
}

function nen_pbs_embed( $id ) {
	return '<object class="video-embed video-pbs" style="width:100%;" width = "512" height = "328" > 
	<param name = "movie" value = "http://dgjigvacl6ipj.cloudfront.net/media/swf/PBSPlayer.swf" > 
	</param><param name="flashvars" value="video=http://video.pbs.org/videoPlayerInfo/' . $id . '&player=viral&end=0" /> 
	<param name="allowFullScreen" value="true"></param > 
	<param name = "allowscriptaccess" value = "always" > </param>
	<param name="wmode" value="transparent"></param >
	<embed src="http://dgjigvacl6ipj.cloudfront.net/media/swf/PBSPlayer.swf" flashvars="video=http://video.pbs.org/videoPlayerInfo/' . $id . '&player=viral&end=0" type="application/x-shockwave-flash" allowscriptaccess="always" wmode="transparent" allowfullscreen="true" width="512" height="328" bgcolor="#000000"></embed></object>';
}