<?php

/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://duke.io
 * @since      0.0.1
 *
 * @package    Genesis_Post_Social_Buttons
 * @subpackage Genesis_Post_Social_Buttons/admin/partials
 */
?>

<div class="wrap">
  <form action='options.php' method='post'>

    <h2>Social buttons below posts</h2>

    <?php
    settings_fields( $this->plugin_name );
    do_settings_sections( $this->plugin_name );
    submit_button();
    ?>

  </form>
</div>
