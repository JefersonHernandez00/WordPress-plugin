<?php


/**
 * Register settings and options for a WordPress plugin
 */

function myplugin_register_settings() {
  // Register two settings, 'myplugin_time_reading' and 'myplugin_estimated_time', with the 'myplugin_options_group' group
  // The third argument 'myplugin_callback' is the callback function to sanitize the settings data
	register_setting( 'myplugin_options_group', 'myplugin_time_reading', 'myplugin_callback' );
	register_setting( 'myplugin_options_group', 'myplugin_estimated_time', 'myplugin_callback' );
}
// Add an action to the 'admin_init' hook to execute the 'myplugin_register_settings' function
add_action( 'admin_init', 'myplugin_register_settings' );

/**
 * Register options page for the plugin in the WordPress dashboard
 */
function myplugin_register_options_page() {
  // Add a new theme options page, with the title "Theme Customization" and the menu title "Theme Options"
	add_theme_page("Theme Customization", "Theme Options", "manage_options", "theme-options", "myplugin_options_page", null, 99);
}
// Add an action to the 'admin_menu' hook to execute the 'myplugin_register_options_page' function
add_action('admin_menu', 'myplugin_register_options_page');


/**
 * Display options page content in the WordPress dashboard
 */
function myplugin_options_page() {
  // Check if the current user has the manage_options capability
	if (!current_user_can('manage_options')) {
    // If the user doesn't have the capability, display an error message and exit the function
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

  // Start of the content for the options page
	?>
	<div>
		<h2>ACME Plugin</h2>
		<!-- Form to submit options to the database -->
		<form method="post" action="options.php">
			<!-- Use the settings_fields function to add nonces and a hidden field for security -->
			<?php settings_fields( 'myplugin_options_group' ); ?>
			<h3>This are my options</h3>
			<p>Field one will be Read Time and Field two will be Estimated Time <strong>in minutes<strong></strong>.</p>
			<table>
				<tr valign="top">
					<th scope="row" style="text-align:left;"><label for="myplugin_option_name">Reading time:</label></th>
					<td><input type="text" id="myplugin_time_reading" name="myplugin_time_reading" value="<?php echo get_option('myplugin_time_reading'); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row" style="text-align:left;"><label for="myplugin_option_name">Estimated time:</label></th>
					<td><input type="text" id="myplugin_estimated_time" name="myplugin_estimated_time" value="<?php echo get_option('myplugin_estimated_time'); ?>" /></td>
				</tr>
			</table>
			<!-- Submit button for the options form -->
			<?php  submit_button(); ?>
		</form>
	</div>
	<?php


}
