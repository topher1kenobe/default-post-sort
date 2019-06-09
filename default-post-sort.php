<?php
/**
 * Plugin Name:       Default Post Sort
 * Description:       Provides a UI to dictate a post element to sort posts on. This does NOT let you arbitrarily sort posts.  You choose something like Title, Date, etc.
 * Version:           1.0
 * Author:            Topher
 */


if ( file_exists( plugin_dir_path( __FILE__ ) . 'dps-admin.class.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'dps-admin.class.php';
}

if ( file_exists( plugin_dir_path( __FILE__ ) . 'dps-action.class.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'dps-action.class.php';
}
