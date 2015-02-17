<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://duke.io
 * @since             0.0.1
 * @package           Genesis_Post_Social_Buttons
 *
 * @wordpress-plugin
 * Plugin Name:       Genesis Post Social Buttons
 * Plugin URI:        http://www.dukeux.com/labs/plugins
 * Description:       Inserts Facebook share link and Instagram profile link after each post.
 * Version:           0.0.1
 * Author:            Duke UX
 * Author URI:        http://duke.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       genesis-post-social-buttons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-genesis-post-social-buttons-activator.php
 */
function activate_genesis_post_social_buttons() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-genesis-post-social-buttons-activator.php';
  Genesis_Post_Social_Buttons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-genesis-post-social-buttons-deactivator.php
 */
function deactivate_genesis_post_social_buttons() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-genesis-post-social-buttons-deactivator.php';
  Genesis_Post_Social_Buttons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_genesis_post_social_buttons' );
register_deactivation_hook( __FILE__, 'deactivate_genesis_post_social_buttons' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-genesis-post-social-buttons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_genesis_post_social_buttons() {

  $plugin = new Genesis_Post_Social_Buttons();
  $plugin->run();

}
run_genesis_post_social_buttons();
