<?php

// ad_nth_settings_page() displays the page content for the Test Settings submenu
//must check that the user has the required capability 
if (!current_user_can('manage_options')) {
  wp_die( __('You do not have sufficient permissions to access this page.') );
}

// variables for the field and option names 
$ad_nth_adcode_opt_name = 'ad_nth_adcode';
$ad_nth_paragraph_opt_name = 'ad_nth_paragraph';
$ad_nth_hidden_field_name = 'ad_nth_submit_hidden';
$nth_adcode_field_name = 'ad_nth_adcode';
$nth_paragraph_field_name = 'ad_nth_paragraph';
$nth_paragraph_field_error = false;

// Read in existing option value from database
$ad_nth_adcode_opt_value = get_option( $ad_nth_adcode_opt_name, '' );
$nth_paragraph_opt_value = get_option( $ad_nth_paragraph_opt_name, '3' );

// See if the user has posted us some information
// If they did, this hidden field will be set to 'Y'
if( isset($_POST[ $ad_nth_hidden_field_name ]) && $_POST[ $ad_nth_hidden_field_name ] == 'Y' ) {
	// Read their posted value
	$ad_nth_adcode_opt_value = $_POST[ $nth_adcode_field_name ];
	$nth_paragraph_opt_value = stripslashes_deep($_POST[ $nth_paragraph_field_name ]);

	// Save the posted value in the database
	update_option( $ad_nth_adcode_opt_name, $ad_nth_adcode_opt_value );
	if(is_numeric($nth_paragraph_opt_value)) {
		update_option( $ad_nth_paragraph_opt_name, $nth_paragraph_opt_value );
	} else {
		$nth_paragraph_field_error = true;
		$nth_paragraph_opt_value = get_option( $ad_nth_paragraph_opt_name, '3' );
	}

	// Put a "settings saved" message on the screen

?>
<div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
<?php

}

// Now display the settings editing screen

echo '<div class="wrap">';

// header

echo "<h2>" . __( 'Menu Test Plugin Settings', 'menu-test' ) . "</h2>";

// settings form

?>

<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $ad_nth_hidden_field_name; ?>" value="Y">

<p>&nbsp;</p>
<h3><?php _e("nth Paragraph:", 'menu-test' ); ?></h3>
<input type="text" class="error" size="5" name="<?php echo $nth_paragraph_field_name; ?>" value="<?php echo $nth_paragraph_opt_value; ?>">
<?php if($nth_paragraph_field_error) : ?>
	<div class="error"><p><strong>nth paragraph must be a number</strong></p></div>
<?php endif; ?>
<i>The number of paragraphs to show before the ad appears</i>
<p>&nbsp;</p>

<h3><?php _e("Ad code:", 'menu-test' ); ?></h3>
<textarea name="<?php echo $nth_adcode_field_name; ?>" rows="10" cols="100"><?php echo stripslashes_deep($ad_nth_adcode_opt_value); ?></textarea>
<hr />

<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>

</form>
</div>