<?php
/*
Plugin Name: Ad nth Post Paragraph
Description: Adds an ad after nth paragraph for posts
Version: 1.0
Author: Matt Thiessen
Credit: Christoph Trappe
Author URI: https://matt.thiessen.us/
License: GPLv2
*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


//Insert ads after third paragraph of single post content.
function insert_ad_block( $text ) {

if ( is_single() ) :

    $ads_text = '<div class="center">' . stripslashes_deep(get_option( 'ad_nth_adcode', '' )) . '</div>';
    $split_by = "\n";
    $insert_after_1 = get_option( 'ad_nth_paragraph', '3' ); //number of paragraphs
    // $insert_after_2 = 12; //number of paragraphs

    // make array of paragraphs
    $paragraphs = explode( $split_by, $text);

    // if array elements are less than $insert_after_1 set the insert point at the end
    $len = count( $paragraphs );
    if (  $len < $insert_after_1 ) $insert_after_1 = $len;

    // insert $ads_text into the array at the specified point
    array_splice( $paragraphs, $insert_after_1, 0, $ads_text );

    // if($len >= 15)
    //     array_splice( $paragraphs, $insert_after_2, 0, $ads_text );

    $new_text = '';

    // loop through array and build string for output
    foreach( $paragraphs as $paragraph ) {
        $new_text .= $paragraph . "\n"; 
    }

    return $new_text;

endif;

return $text;

}
add_filter('the_content', 'insert_ad_block');

if(is_admin()) {
    include_once 'inc/admin/menu.php';
}