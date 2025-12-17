<?php
/**
 * The main plugin class
 *
 * @package ImageOptimizer
 * @author  Danh Le
 */

namespace ImageOptimizer;

use ImageOptimizer\Admin\Dashboard;
use ImageOptimizer\Admin\Settings;
use ImageOptimizer\Core\Optimizer;
use ImageOptimizer\Core\API;
use ImageOptimizer\Core\Database;

/**
 * Core plugin class
 */
class Core {

	/**
	 * The single instance of this class
	 *
	 * @var Core
	 */
	private static $instance = null;

	/**
	 * The plugin version
	 *
	 * @var string
	 */
	public $version = IMAGE_OPTIMIZER_VERSION;

	/**
	 * The plugin path
	 *
	 * @var string
	 */
	public $path = IMAGE_OPTIMIZER_PATH;

	/**
	 * The plugin URL
	 *
	 * @var string
	 */
	public $url = IMAGE_OPTIMIZER_URL;

	/**
	 * Get the singleton instance
	 *
	 * @return Core
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	private function __construct() {
		$this->init();
	}

	/**
	 * Initialize the plugin
	 */
	private function init() {
		// Create database tables if they don't exist
		Database::create_tables();
		
		// Load translations
		load_plugin_textdomain(
			'image-optimizer',
			false,
			dirname( IMAGE_OPTIMIZER_BASENAME ) . '/languages'
		);

		// Initialize components
		$this->init_admin();
		$this->init_optimizer();
		$this->init_api();

		// Add WordPress hooks
		add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Optimize featured image sizes for better LCP
		add_filter( 'post_thumbnail_size', array( $this, 'optimize_featured_image_size' ) );
	}

	/**
	 * Initialize admin components
	 */
	private function init_admin() {
		// Initialize admin classes - Settings needs to be instantiated to register admin_init hooks
		// even before is_admin() fully evaluates (during early plugin loading)
		new Dashboard();
		new Settings();
	}

	/**
	 * Initialize image optimizer
	 */
	private function init_optimizer() {
		new Optimizer();
	}

	/**
	 * Initialize REST API
	 */
	private function init_api() {
		new API();
	}

	/**
	 * Register admin menu
	 */
	public function register_admin_menu() {
		add_menu_page(
			__( 'Image Optimizer', 'image-optimizer' ),
			__( 'Image Optimizer', 'image-optimizer' ),
			'manage_options',
			'image-optimizer',
			array( $this, 'render_dashboard' ),
			'dashicons-format-image',
			80
		);

		add_submenu_page(
			'image-optimizer',
			__( 'Settings', 'image-optimizer' ),
			__( 'Settings', 'image-optimizer' ),
			'manage_options',
			'image-optimizer-settings',
			array( $this, 'render_settings' )
		);
	}

	/**
	 * Render dashboard
	 */
	public function render_dashboard() {
		Dashboard::render();
	}

	/**
	 * Render settings
	 */
	public function render_settings() {
		Settings::render();
	}

	/**
	 * Enqueue frontend scripts
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			'image-optimizer-lazy',
			IMAGE_OPTIMIZER_URL . 'assets/js/lazy-load.js',
			array(),
			IMAGE_OPTIMIZER_VERSION,
			true
		);
	}

	/**
	 * Plugin activation hook
	 */
	public static function activate() {
		// Database tables will be created on plugins_loaded when autoloader is ready
		
		// Set default options
		if ( ! get_option( 'image_optimizer_settings' ) ) {
			update_option( 'image_optimizer_settings', array(
				'compression_level' => 'medium',
				'enable_webp'        => true,
				'enable_lazy_load'   => true,
				'auto_optimize'      => false,
			) );
		}

		// Flush rewrite rules
		flush_rewrite_rules();
	}

	/**
	 * Plugin deactivation hook
	 */
	public static function deactivate() {
		// Cleanup if needed
		flush_rewrite_rules();
	}

	/**
	 * Optimize featured image display size for better LCP
	 * Uses medium (300x200) by default to prioritize LCP over image size
	 * Browser's srcset will serve appropriate size via responsive images
	 *
	 * @param string $size The current thumbnail size.
	 * @return string The optimized size.
	 */
	public function optimize_featured_image_size( $size ) {
		// Always use medium for featured images to minimize LCP
		// Medium (300x200) is small but acceptable, forces browser to use smaller variant
		// This triggers srcset to download appropriate size for viewport
		return 'medium';
	}
}
