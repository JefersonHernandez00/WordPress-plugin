<?php

/**
 * Fired during plugin activation
 *
 * @link       https://https://github.com/JefersonHernandez00
 * @since      1.0.0
 *
 * @package    Products_Acme
 * @subpackage Products_Acme/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Products_Acme
 * @subpackage Products_Acme/includes
 * @author     Jeferson Hernandez <jefersonhernandez81@gmail.com>
 */
class Products_Acme_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		/**
		 * the corresponding values time reading and estimated time are added
		 */

		add_option( 'myplugin_time_reading', '60', '', 'yes');
  
  		add_option( 'myplugin_estimated_time', '240', '', 'yes');

	}

}
