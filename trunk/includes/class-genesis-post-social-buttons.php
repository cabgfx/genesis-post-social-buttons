<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       http://duke.io
 * @since      0.0.1
 *
 * @package    Genesis_Post_Social_Buttons
 * @subpackage Genesis_Post_Social_Buttons/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      0.0.1
 * @package    Genesis_Post_Social_Buttons
 * @subpackage Genesis_Post_Social_Buttons/includes
 * @author     Duke UX <hello@duke.io>
 */
class Genesis_Post_Social_Buttons {

  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since    0.0.1
   * @access   protected
   * @var      Genesis_Post_Social_Buttons_Loader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since    0.0.1
   * @access   protected
   * @var      string    $plugin_name    The string used to uniquely identify this plugin.
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since    0.0.1
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  /**
   * The key used to save and load required options from the WordPress database.
   *
   * The settings are handled in the class Genesis_Post_Social_Buttons_Admin_External_Header_Admin.
   *
   * @since    1.1.0
   * @access   protected
   * @var      string    $version    The key used for the array that serializes the options in the database.
   */
  protected $options_group_name;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the Dashboard and
   * the public-facing side of the site.
   *
   * @since    0.0.1
   */
  public function __construct() {

    $this->plugin_name = 'genesis-post-social-buttons';
    $this->version = '0.0.1';
    $this->options_group_name = $this->plugin_name . '_settings';

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
   * - Genesis_Post_Social_Buttons_Loader. Orchestrates the hooks of the plugin.
   * - Genesis_Post_Social_Buttons_i18n. Defines internationalization functionality.
   * - Genesis_Post_Social_Buttons_Admin. Defines all hooks for the dashboard.
   * - Genesis_Post_Social_Buttons_Public. Defines all hooks for the public side of the site.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since    0.0.1
   * @access   private
   */
  private function load_dependencies() {

    /**
     * The class responsible for orchestrating the actions and filters of the
     * core plugin.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-genesis-post-social-buttons-loader.php';

    /**
     * The class responsible for defining internationalization functionality
     * of the plugin.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-genesis-post-social-buttons-i18n.php';

    /**
     * The class responsible for defining all actions that occur in the Dashboard.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-genesis-post-social-buttons-admin.php';

    /**
     * The class responsible for defining all actions that occur in the public-facing
     * side of the site.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-genesis-post-social-buttons-public.php';

    $this->loader = new Genesis_Post_Social_Buttons_Loader();

  }

  /**
   * Define the locale for this plugin for internationalization.
   *
   * Uses the Genesis_Post_Social_Buttons_i18n class in order to set the domain and to register the hook
   * with WordPress.
   *
   * @since    0.0.1
   * @access   private
   */
  private function set_locale() {

    $plugin_i18n = new Genesis_Post_Social_Buttons_i18n();
    $plugin_i18n->set_domain( $this->get_plugin_name() );

    $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

  }

  /**
   * Register all of the hooks related to the dashboard functionality
   * of the plugin.
   *
   * @since    0.0.1
   * @access   private
   */
  private function define_admin_hooks() {

    $plugin_admin = new Genesis_Post_Social_Buttons_Admin( $this->get_plugin_name(), $this->get_version(), $this->get_options_group_name() );

    $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_admin_menu' );
    $this->loader->add_action( 'admin_init', $plugin_admin, 'init_admin_settings' );

  }

  /**
   * Register all of the hooks related to the public-facing functionality
   * of the plugin.
   *
   * @since    0.0.1
   * @access   private
   */
  private function define_public_hooks() {

    $plugin_public = new Genesis_Post_Social_Buttons_Public( $this->get_plugin_name(), $this->get_version(), $this->get_options_group_name() );

    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
    $this->loader->add_action( 'genesis_entry_footer', $plugin_public, 'add_social_buttons_below_post', 100 );
  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    0.0.1
   */
  public function run() {
    $this->loader->run();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     0.0.1
   * @return    string    The name of the plugin.
   */
  public function get_plugin_name() {
    return $this->plugin_name;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     0.0.1
   * @return    Genesis_Post_Social_Buttons_Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader() {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     0.0.1
   * @return    string    The version number of the plugin.
   */
  public function get_version() {
    return $this->version;
  }

  public function get_options_group_name() {
    return $this->options_group_name;
  }

}
