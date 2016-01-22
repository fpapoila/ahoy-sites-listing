<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://revolucaodosbytes.pt
 * @since      1.0.0
 *
 * @package    Ahoy_Sites_Listing
 * @subpackage Ahoy_Sites_Listing/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ahoy_Sites_Listing
 * @subpackage Ahoy_Sites_Listing/public
 * @author     Revolução dos Bytes <contacto@revolucaodosbytes.pt>
 */
class Ahoy_Sites_Listing_Public {

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
	 * The address of the API.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $address    The IP address of the API.
	 */
	private $address = "46.101.64.62";

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
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
		 * defined in Ahoy_Sites_Listing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ahoy_Sites_Listing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ahoy-sites-listing-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ahoy_Sites_Listing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ahoy_Sites_Listing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ahoy-sites-listing-public.js', array( 'jquery' ), $this->version, false );
	}
    
    /**
	 * Register the shortcode to show all the sites the the API returns.
	 *
	 * @since    1.0.0
	 */
    public function registerListSites()
    {        
        add_shortcode('ahoy-list', array($this,'showWebsites'));
    }
    
    /**
	 * Return the result to the shortcode function.
	 *
	 * @since    1.0.0
	 */
    function showWebsites()
    {    
        $sites = "";
        if (is_array(json_decode($this->getWebsites()))) {
            foreach(json_decode($this->getWebsites()) as $websites)
            {
                $sites .= "<a class=\"censored\" href=\"http://".$websites."\">".$websites."</a><br/>";
            }
        }
        return $sites;
    }
    
    
    /**
	 * Fetch the information from the API, if not present in cache.
	 *
	 * @since    1.0.0
	 */
    private function getWebsites()
    {
        $body = wp_cache_get( 'sitesList' );
        if ( false === $result ) {
            $response = wp_remote_get( "http://".$this->address."/api/sites" );
            if( is_array($response) ) {
                $body = $response['body']; // use the content
            }
            wp_cache_set( 'sitesList', $body, '', 5 * MINUTE_IN_SECONDS );
        }
        return $body;
    }

}
