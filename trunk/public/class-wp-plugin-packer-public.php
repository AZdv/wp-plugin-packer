<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/AZdv/wp-plugin-packer
 * @since      1.0.0
 *
 * @package    Wp_Plugin_Packer
 * @subpackage Wp_Plugin_Packer/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Wp_Plugin_Packer
 * @subpackage Wp_Plugin_Packer/public
 * @author     Asaf Zamir <dev@azdv.co>
 */
class Wp_Plugin_Packer_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wp_plugin_packer    The ID of this plugin.
	 */
	private $wp_plugin_packer;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $wp_plugin_packer       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $wp_plugin_packer, $version ) {

		$this->wp_plugin_packer = $wp_plugin_packer;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Plugin_Packer_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Plugin_Packer_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->wp_plugin_packer, plugin_dir_url( __FILE__ ) . 'css/wp-plugin-packer-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Plugin_Packer_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Plugin_Packer_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->wp_plugin_packer, plugin_dir_url( __FILE__ ) . 'js/wp-plugin-packer-public.js', array( 'jquery' ), $this->version, false );

	}

}