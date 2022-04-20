<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mrinalbd.com/
 * @since             1.0.0
 * @package           Orbit_Team
 *
 * @wordpress-plugin
 * Plugin Name:       Orbit Team
 * Plugin URI:        https://github.com/mrinal013/orbit-team
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Mrinal Haque
 * Author URI:        https://mrinalbd.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       orbit-team
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ORBIT_TEAM_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-orbit-team-activator.php
 */
function activate_orbit_team() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-orbit-team-activator.php';
	Orbit_Team_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-orbit-team-deactivator.php
 */
function deactivate_orbit_team() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-orbit-team-deactivator.php';
	Orbit_Team_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_orbit_team' );
register_deactivation_hook( __FILE__, 'deactivate_orbit_team' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-orbit-team.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_orbit_team() {

	$plugin = new Orbit_Team();
	$plugin->run();

}
run_orbit_team();
