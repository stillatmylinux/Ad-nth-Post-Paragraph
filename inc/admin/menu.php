<?php

add_action( 'admin_menu', 'ad_nth_menu' );

function ad_nth_menu() {
	add_options_page( 'Ad nth Options', 'Ad nth', 'read', 'ad-nth-settings', 'ad_nth_settings_page' );
}

function ad_nth_settings_page() {

    include 'admin-page.php';
 
}