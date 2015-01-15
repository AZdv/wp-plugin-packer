<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       https://github.com/AZdv/wp-plugin-packer
 * @since      1.0.0
 *
 * @package    Wp_Plugin_Packer
 * @subpackage Wp_Plugin_Packer/admin
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Wp_Plugin_Packer_Admin {

	private $wp_plugin_packer;
	private $version;
	private $options;

	public function __construct( $wp_plugin_packer, $version ) {

		$this->wp_plugin_packer = $wp_plugin_packer;
		$this->version = $version;
		
		add_action( 'admin_menu', array( $this, 'plugin_packer_menu' ) );
		add_action( 'admin_init', array( $this, 'plugin_packer_init' ) );

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->wp_plugin_packer, plugin_dir_url( __FILE__ ) . 'css/wp-plugin-packer-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the dashboard.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( $this->wp_plugin_packer, plugin_dir_url( __FILE__ ) . 'js/wp-plugin-packer-admin.js', array( 'jquery', 'jquery-ui-sortable' ), $this->version, false );
	}

	/**
	 * Admin Init
	 */
	public function plugin_packer_init() {
		register_setting( $this->wp_plugin_packer, $this->wp_plugin_packer . '_plugin_packs' ); // is this needed?

		add_settings_section( 
			$this->wp_plugin_packer . '_plugin_packs_section', // ID
			'', // Title
			array( $this, 'plugin_packs_callback' ), // callback
			$this->wp_plugin_packer . '_settings' // page's menu slug (from add_options_page)
			);

		/*add_settings_field( 
			$this->wp_plugin_packer . '_plugin_packs', // ID
			'', // Title
			array( $this, 'plugin_packs_callback' ), // callback
			$this->wp_plugin_packer . '_settings', // page's menu slug (from add_options_page)
			$this->wp_plugin_packer . '_plugin_packs_section' // section ID (from add_settings_section)
			);*/

	}

	public function plugin_packer_menu() {
		add_options_page( 'Plugin Packer', 'Plugin Packer', 'manage_options', $this->wp_plugin_packer . '_settings', function() { 
			ob_start();
			require_once plugin_dir_path( __FILE__ ) . 'partials/wp-plugin-packer-admin-display.php'; 
			echo ob_get_clean();
		} );
	}

	public function plugin_packs_callback() {
		$plugin_packs = $this->get_plugin_packs();
		foreach( $plugin_packs as $key => $pack ) {
			$str = '<div>' . __( 'Drag & Drop to sort' ) . '</div>';
			$str .= sprintf( '<h3>%s</h3>', $pack['name'] );
			$str .= sprintf( '<table class="%s widefat plugins"><tbody>', $this->wp_plugin_packer );
			foreach( $pack['plugins'] as $mkey => $plugin ) {
				$str .= sprintf( '<tr class="%s">', is_plugin_active( $plugin['file'] ) ? 'active' : 'inactive' );
				$str .= sprintf( '<th class="check-column plugin-name"><label><input type="checkbox" name="%s" %s /></label></th>' , $this->wp_plugin_packer . '_plugin_packs', '' );
				$str .= sprintf( '<td class="plugin-title"><strong>%s</strong><div>Version: %s , %s</div></td>' , $plugin['name'], $plugin['version'], ( is_plugin_active( $plugin['file'] ) ? 'Activated' : 'Deactivated' ) );
				$str .= '</tr>';
			}
			$str .= '</tbody></table>';
		}
		echo $str;
	}

	/*public function plugin_packs_section_callback() {
		//Section HTML
	}*/

	public function get_plugin_packs() {
		$plugin_packs = wp_cache_get( $this->wp_plugin_packer . '_plugin_packs' );
		if ( false === $plugin_packs ) {
			$plugin_packs = $this->init_plugin_packs();
		}
		return $plugin_packs;
	}

	public function init_plugin_packs() {
		$plugins_array = get_plugins();
		$plugin_packs = [];
		foreach( $plugins_array as $key => $plugin ) {
			$plugin_packs[ sanitize_title( $plugin[ 'Name' ] ) ] = [
				'name' => $plugin[ 'Name' ],
				'version' => $plugin[ 'Version' ],
				'file' => $key,
			];
		}
		$plugin_packs = [
			'default' => [
				'name' => 'Default Pack',
				'plugins' => $plugin_packs
			]
		];
		return $plugin_packs;
	}



}  