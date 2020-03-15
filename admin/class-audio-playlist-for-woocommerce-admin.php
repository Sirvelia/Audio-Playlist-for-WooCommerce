<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sirvelia.com
 * @since      1.0.0
 *
 * @package    Audio_Playlist_for_WooCommerce_
 * @subpackage Audio_Playlist_for_WooCommerce_/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Audio_Playlist_for_WooCommerce_
 * @subpackage Audio_Playlist_for_WooCommerce_/admin
 * @author     Sirvelia <info@sirvelia.com>
 */
class Audio_Playlist_for_WooCommerce__Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Audio_Playlist_for_WooCommerce__Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Audio_Playlist_for_WooCommerce__Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/audio-playlist-for-woocommerce-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Audio_Playlist_for_WooCommerce__Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Audio_Playlist_for_WooCommerce__Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/audio-playlist-for-woocommerce-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Loads Composer dependencies.
	 *
	 * @since    1.0.0
	 */
	public function load_vendor() {
		require_once SIMPLE_CSV_TABLES_PATH . 'vendor/autoload.php';
    \Carbon_Fields\Carbon_Fields::boot();
	}


	/**
	 * Adds custom meta fields to Product (Playlist).
	 *
	 * @since    1.0.0
	 */
	function sirvelia_attach_product_meta() {

	  Container::make( 'post_meta', 'Playlist' )
	      ->where( 'post_type', '=', 'product' )
	      ->add_fields( array(
	        Field::make( 'media_gallery', 'crb_product_playlist', __( 'Samples' ) )
	          ->set_type( array( 'audio' ) )
	      ) );

	  Container::make( 'post_meta', 'Download Link' )
	    ->where( 'post_type', '=', 'product' )
	    ->add_fields( array(
	      Field::make( 'text', 'crb_product_link', 'Link de descarga para distribuidores' )
	        ->set_attribute( 'type', 'url' )
	        ->set_attribute( 'placeholder', 'https://' )
	    ) );

	}

}