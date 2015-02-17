<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://duke.io
 * @since      0.0.1
 *
 * @package    Genesis_Post_Social_Buttons
 * @subpackage Genesis_Post_Social_Buttons/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Genesis_Post_Social_Buttons
 * @subpackage Genesis_Post_Social_Buttons/public
 * @author     Duke UX <hello@duke.io>
 */
class Genesis_Post_Social_Buttons_Public {

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

  /**
   * The key used to save and load required options from the WordPress database.
   *
   * @since    0.0.1
   * @access   private
   * @var      string    $version    The key used for the array that serializes the options in the database.
   */
  private $options_group_name;

  private $user_config;

  /**
   * Initialize the class and set its properties.
   *
   * @since    0.0.1
   * @var      string    $plugin_name           The name of the plugin.
   * @var      string    $version               The version of this plugin.
   * @var      string    $options_group_name    The key used to save/load plugin-specifc options from the database.
   */
  public function __construct( $plugin_name, $version, $options_group_name ) {
    $this->plugin_name =        $plugin_name;
    $this->version =            $version;
    $this->options_group_name = $options_group_name;
    $this->user_config =        $this->get_plugin_configuration();
  }

  /**
   * Load FontAwesome here, instead of grabbing it from the WhiteAlbum API.
   *
   * @since    0.0.1
   */
  public function enqueue_styles() {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in White_Album_External_Header_Public_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The White_Album_External_Header_Public_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), $this->version, 'all' );
    wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/genesis-post-social-buttons-public.css', array(), $this->version, 'all' );
  }

  public function add_social_buttons_below_post() {
    global $post;
    $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . get_permalink($post->ID);
    $instagram_url = $this->user_config['instagram_url'];

    echo <<< HTML
      <div class="genesis-post-social-buttons">
        <a href="$facebook_url" class="genesis-post-social-buttons-facebook"><i class="fa fa-2x fa-facebook-official"></i></a>
        <a href="$instagram_url" class="genesis-post-social-buttons-instagram"><i class="fa fa-2x fa-instagram"></i></a>
      </div>
HTML;
  }

  private function get_plugin_configuration() {
    return get_option( $this->options_group_name );
  }

}
