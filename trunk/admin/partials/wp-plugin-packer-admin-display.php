<?php

/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/AZdv/wp-plugin-packer
 * @since      1.0.0
 *
 * @package    Wp_Plugin_Packer
 * @subpackage Wp_Plugin_Packer/admin/partials
 */
?>
<div class="wrap">
	<h2><?php _e( 'Plugin Packer Settings' ) ?></h2>

	<form action="options.php" method="post">
		<?php settings_fields( $this->wp_plugin_packer ) ?>
		<?php do_settings_sections( $this->wp_plugin_packer . '_settings' ) ?>

		<?php submit_button(); ?>
	</form>
</div>