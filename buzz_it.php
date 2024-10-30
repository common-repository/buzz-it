<?php
/*
Plugin Name:  Google Buzz-It
Plugin URI: http://www.vjcatkick.com/?page_id=16115
Description: Append 'Buzz-it' button at bottom of each entries.
Version: 0.0.1
Author: V.J.Catkick
Author URI: http://www.vjcatkick.com/
*/

/*
License: GPL
Compatibility: WordPress 2.6 with Widget-plugin.

Installation:
Place the widget_single_photo folder in your /wp-content/plugins/ directory
and activate through the administration panel, and then go to the widget panel and
drag it to where you would like to have it!
*/

/*  Copyright V.J.Catkick - http://www.vjcatkick.com/

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


/* Changelog
* Feb 14 2010 - v0.0.1
- Initial release
*/


function format_buzz_it_button( $post_item ) {

	$max_characters = 128;

	$base_url = 'http://www.google.com/reader/link';
	$url = $post_item->guid;
	$title = $post_item->post_title;
	$snippet = $post_item->post_excerpt;
	$srcURL = get_bloginfo( 'url' );
	$srcTitle = get_bloginfo( 'name' );
	$isRedirectBack = 1;

	if( !$snippet ) $snippet = $post_item->post_content;
	$snippet_org = htmlspecialchars( strip_tags( $snippet ) );
	$snippet = mb_substr( $snippet_org, 0, $max_characters );
	if( mb_strlen( $snippet_org ) > $max_characters ) $snippet .= '...';

	$base_url .= '?url=' . $url;
	$base_url .= '&title=' . urlencode( $title );
	$base_url .= '&snippet=' . urlencode( $snippet );
	$base_url .= '&srcURL=' . $srcURL;
	$base_url .= '&srcTitle=' . $srcTitle;
	$icon_url = get_bloginfo( 'wpurl' ) . '/wp-content/plugins/buzz-it/images/buzz-icon.png';

	$output = '<a href="' . $base_url . '" target="_blank" ><img align="right" alt="Buzz it!" src="' . $icon_url . '" border="0" style="border: 0px;" /></a><br clear="all" />';

	return( $output );
} /* format_buzz_it_button() */

function append_buzz_it_button( $content ) {
	global $post;

	$content .= format_buzz_it_button( $post );

	return( $content );
} /* append_buzz_it_button() */

add_filter( 'the_content', 'append_buzz_it_button' );

?>