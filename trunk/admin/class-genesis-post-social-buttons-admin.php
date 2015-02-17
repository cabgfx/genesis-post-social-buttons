<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://duke.io
 * @since      0.0.1
 *
 * @package    Genesis_Post_Social_Buttons
 * @subpackage Genesis_Post_Social_Buttons/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Genesis_Post_Social_Buttons
 * @subpackage Genesis_Post_Social_Buttons/admin
 * @author     Duke UX <hello@duke.io>
 */
class Genesis_Post_Social_Buttons_Admin {

  /**
   * The ID of this plugin.
   *
   * @since    0.0.1
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    0.0.1
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  private $options_group_name;

  /**
   * Initialize the class and set its properties.
   *
   * @since    0.0.1
   * @var      string    $plugin_name       The name of this plugin.
   * @var      string    $version    The version of this plugin.
   */
  public function __construct( $plugin_name, $version, $options_group_name ) {

    $this->plugin_name = $plugin_name;
    $this->version = $version;
    $this->options_group_name = $options_group_name;

  }

  public function add_admin_menu() {
    add_submenu_page(
      'themes.php',
      'Social Buttons settings',
      'Social Buttons',
      'manage_options',
      $this->plugin_name,
      array(&$this, 'options_page')
    );
  }

  public function init_admin_settings(  ) {
    register_setting( $this->plugin_name, $this->options_group_name );

    add_settings_section(
      ($this->plugin_name . '_section'),
      __( 'Facebook share button and link to Instagram profile', $this->plugin_name ),
      array(&$this, 'settings_section_callback'),
      $this->plugin_name
    );

    add_settings_field(
      'instagram_url',
      __( 'The full URL to your Instagram profile, incl. http://', $this->plugin_name ),
      array(&$this, 'instagram_url_render'),
      $this->plugin_name,
      ($this->plugin_name . '_section')
    );
  }

  public function instagram_url_render(  ) {
    echo $this->build_settings_field('instagram_url');
  }

  public function settings_section_callback(  ) {
    echo __( 'Add your details below', $this->plugin_name );
  }

  public function options_page(  ) {
    include_once plugin_dir_path( dirname( __FILE__ ) ) . "admin/partials/$this->plugin_name-admin-display.php";
  }

  private function build_settings_field($option_key) {
    $options = get_option( $this->options_group_name );
    $value = (isset($options[$option_key]) ? $options[$option_key] : '');

    return '<input type="text" name="' . $this->options_group_name . '['. $option_key .']" value="' . $value . '">';
  }

}
