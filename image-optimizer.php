<?php
/**
 * Image Optimizer Plugin
 *
 * @package           ImageOptimizer
 * @author            Danh Le
 * @license           GPL v2 or later
 * @link              https://danhle.net
 *
 * @wordpress-plugin
 * Plugin Name:       Image Optimizer
 * Plugin URI:        https://github.com/odanree/image-optimizer
 * Description:       Advanced image optimization plugin with compression, lazy loading, and WebP conversion.
 * Version:           1.0.0
 * Author:            Danh Le
 * Author URI:        https://danhle.net
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       image-optimizer
 * Domain Path:       /languages
 * Requires at least: 5.0
 * Requires PHP:      7.4
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define plugin constants
define( 'IMAGE_OPTIMIZER_VERSION', '1.0.0' );
define( 'IMAGE_OPTIMIZER_PATH', plugin_dir_path( __FILE__ ) );
define( 'IMAGE_OPTIMIZER_URL', plugin_dir_url( __FILE__ ) );
define( 'IMAGE_OPTIMIZER_BASENAME', plugin_basename( __FILE__ ) );

// Include the autoloader
require_once IMAGE_OPTIMIZER_PATH . 'includes/class-autoloader.php';

// Register the autoloader
\ImageOptimizer\Autoloader::register();

// Manually include core classes to ensure they're loaded
require_once IMAGE_OPTIMIZER_PATH . 'includes/core/class-database.php';
require_once IMAGE_OPTIMIZER_PATH . 'includes/core/class-optimizer.php';
require_once IMAGE_OPTIMIZER_PATH . 'includes/core/class-api.php';
require_once IMAGE_OPTIMIZER_PATH . 'includes/admin/class-dashboard.php';
require_once IMAGE_OPTIMIZER_PATH . 'includes/admin/class-settings.php';

/**
 * The main plugin class
 */
use ImageOptimizer\Core;
use ImageOptimizer\Core\API;

/**
 * Initialize REST API early
 */
add_action( 'rest_api_init', function() {
	$api = new API();
	$api->register_routes();
}, 1 );

/**
 * Activate the plugin
 */
register_activation_hook( __FILE__, array( Core::class, 'activate' ) );

/**
 * Deactivate the plugin
 */
register_deactivation_hook( __FILE__, array( Core::class, 'deactivate' ) );

/**
 * Initialize the plugin
 */
add_action( 'init', function() {
	Core::get_instance();
}, 20 );
