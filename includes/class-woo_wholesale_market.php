<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://cedcoss.com/
 * @since      1.0.0
 *
 * @package    Woo_wholesale_market
 * @subpackage Woo_wholesale_market/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Woo_wholesale_market
 * @subpackage Woo_wholesale_market/includes
 * @author     Cedcoss <cedcoss@gmail.com>
 */
class Woo_wholesale_market {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Woo_wholesale_market_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WOO_WHOLESALE_MARKET_VERSION' ) ) {
			$this->version = WOO_WHOLESALE_MARKET_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'woo_wholesale_market';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woo_wholesale_market_Loader. Orchestrates the hooks of the plugin.
	 * - Woo_wholesale_market_i18n. Defines internationalization functionality.
	 * - Woo_wholesale_market_Admin. Defines all hooks for the admin area.
	 * - Woo_wholesale_market_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woo_wholesale_market-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woo_wholesale_market-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woo_wholesale_market-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woo_wholesale_market-public.php';

		$this->loader = new Woo_wholesale_market_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Woo_wholesale_market_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Woo_wholesale_market_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Woo_wholesale_market_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_filter( 'woocommerce_settings_tabs_array', $plugin_admin, 'add_settings_tab', 50 );
        
		$this->loader->add_action( 'woocommerce_update_options_wholesale_market', $plugin_admin, 'update_settings' );
		
		$this->loader->add_action( 'woocommerce_sections_wholesale_market', $plugin_admin, 'output_sections');
		$this->loader->add_action( 'woocommerce_settings_wholesale_market', $plugin_admin, 'output' );
		$this->loader->add_action( 'woocommerce_settings_save_wholesale_market', $plugin_admin, 'save' );
		$this->loader->add_action( 'woocommerce_product_options_pricing', $plugin_admin, 'create_custom_field' );
		$this->loader->add_action( 'woocommerce_process_product_meta',  $plugin_admin, 'save_custom_field' );
		$this->loader->add_action( 'woocommerce_product_options_pricing', $plugin_admin, 'create_custom_field_quantity' );
		$this->loader->add_filter('manage_users_columns', $plugin_admin, 'bbloomer_add_new_user_column');
		$this->loader->add_filter( 'manage_users_custom_column', $plugin_admin, 'bbloomer_add_new_user_column_content', 10, 3 );


		
		$this->loader->add_action( 'woocommerce_variation_options_pricing', $plugin_admin, 'bbloomer_add_custom_field_to_variations', 0, 3 );
		$this->loader->add_action( 'woocommerce_save_product_variation', $plugin_admin, 'bbloomer_save_custom_field_variations', 10, 2 );
		$this->loader->add_filter( 'woocommerce_available_variation', $plugin_admin,  'bbloomer_add_custom_field_variation_data' );
		
		$this->loader->add_action( 'woocommerce_variation_options_pricing', $plugin_admin, 'add_quantity_to_variations', 0, 3 );
		$this->loader->add_action( 'woocommerce_save_product_variation', $plugin_admin, 'save_quantity_field_variations', 10, 2 );
		$this->loader->add_filter( 'woocommerce_available_variation', $plugin_admin,  'add_quantity_field_variation_data' );

		$this->loader->add_action( 'init', $plugin_admin, 'xx__update_custom_roles' );

		$this->loader->add_filter( 'personal_options', $plugin_admin, 'make_normal_customer_a_wholesale_customer' );
		$this->loader->add_action( 'edit_user_profile_update', $plugin_admin, 'wk_save_custom_user_profile_fields' );

		$this->loader->add_filter( 'woocommerce_register_form', $plugin_admin, 'make_customer' );
		$this->loader->add_action( 'woocommerce_created_customer', $plugin_admin, 'wk_save_fields' );


		$this->loader->add_action( 'admin_init', $plugin_admin, 'profile_update_user_role');

		// to show wholesale price
		$this->loader->add_action('woocommerce_after_shop_loop_item_title', $plugin_admin, 'shop_loop_make_surplus_price_always_visible', 8 );
		$this->loader->add_action('woocommerce_single_product_summary', $plugin_admin, 'single_product_make_surplus_price_always_visible', 15 );
		// $this->loader->add_action('woocommerce_after_shop_loop_item_title', $plugin_admin, 'shop_loop_make_surplus_price_always_virtual', 9 );
		$this->loader->add_action('woocommerce_available_variation', $plugin_admin, 'shop_loop_for_variation_product', 10, 3 );
		$this->loader->add_action( 'woocommerce_before_calculate_totals', $plugin_admin, 'cart_recalculate_price' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Woo_wholesale_market_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Woo_wholesale_market_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
