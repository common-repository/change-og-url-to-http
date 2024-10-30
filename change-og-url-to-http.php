<?php

/**
 * Plugin Name:       Change OG URL To HTTP
 * Description:       Changes the OG:URL tag added by SEO Plugins from HTTPS to HTTP so you can get back your facebook likes/share count.
 * Version:           1.0
 * Author:            Mukesh Mani
 * Author URI:        http://orbitingweb.com
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
  */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$oghttp_change_og_url = new oghttp_change_og_url();

class oghttp_change_og_url{
	
	private $plugin_name;
	private $plugin_version;
		
		
	public function __construct(){
		
		$this->plugin_name = 'change-og-url-to-http';
		$this->plugin_version = '1.0';
		
		/* Register activation/deactivation hooks */
		register_activation_hook( __FILE__, array( $this, 'activate_change_og_url_to_http') );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate_change_og_url_to_http') );
		
		/* Add fiters to OG URL tag based on plugin active */
		add_filter( 'wpseo_opengraph_url', array($this, 'oghttp_ogurl_yoast_filter'), 10, 1 );
		add_filter( 'fb_og_url', array($this, 'oghttp_ogurl_webdados_filter'), 10, 1 );
		add_filter( 'wpfbogp_url', array($this, 'oghttp_ogurl_wpfbogp_filter'), 10, 1 );
		add_filter( 'aiosp_opengraph_meta', array($this, 'oghttp_ogurl_aioseo_filter'), 10, 3 );	
				
	}
	
		
	/* Run on activation */
	public static function activate_change_og_url_to_http() {
		
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		
		if( get_option('oghttp_get_lastpost_time') != false ){
			return;
		}
		
		add_option( 'oghttp_get_lastpost_time', get_lastpostdate( 'blog','post' ) );
		
	}
	
	/* Run on deactivation */
	public static function deactivate_change_og_url_to_http() {
		
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		
	}
	
	/* Compare current post date with last post date */
	public function oghttp_get_last_post_date(){
		if ( get_option('oghttp_get_lastpost_time') ){
			$oghttp_lpt = get_option('oghttp_get_lastpost_time');
			$oghttp_lpt = strtotime( $oghttp_lpt );
		}
		
		$oghttp_gpd = esc_html( get_the_date('Y/m/d H:i:s') );
		$oghttp_gpd = strtotime( $oghttp_gpd );
		
		if( $oghttp_gpd <= $oghttp_lpt   ) return true;
		
	}
	
		
	
	/* Change OG URL for Yoast */
	public function oghttp_ogurl_yoast_filter( $ogurl ){
		
		if( $this->oghttp_get_last_post_date() ){
			
			if( defined('WPSEO_VERSION') ){
				$ogurl = explode( ':', $ogurl);
				$ogurl_part = $ogurl[1];
				$ogurl = 'http:' . $ogurl_part;
				return $ogurl;
			}
		}
		return $ogurl;	
	}
	
	/* Change OG URL for AIOSEO */
	public function oghttp_ogurl_aioseo_filter( $value, $type, $field ){
		
		if( $this->oghttp_get_last_post_date() ){
			
			if( defined('AIOSEOP_VERSION') ){
				if( $field == 'url' ){
					$ogurl_array = explode( ':', $value );
					$ogurl_part = $ogurl_array[1];
					$value = 'http:'.$ogurl_part;
					return $value;
				}				
			}	
		}
		return $value;
	}
	
	
	/* Change OG URL for Facebook Open Graph, Google+ and Twitter Card Tags */
	public function oghttp_ogurl_webdados_filter( $ogurl ){
		
		if( $this->oghttp_get_last_post_date() ){
			
			if( defined('WEBDADOS_FB_VERSION') ){
				$ogurl = explode( ':', $ogurl);
				$ogurl_part = $ogurl[1];
				$ogurl = 'http:' . $ogurl_part;
				return $ogurl;
			}
			
		}
		return $ogurl;
	}
	
	/* Change OG URL for WordPress Facebook Open Graph protocol plugin */
	public function oghttp_ogurl_wpfbogp_filter( $ogurl ){
		
		if( $this->oghttp_get_last_post_date() ){
			
			if( defined('WPFBOGP_VERSION') ){
				$ogurl = explode( ':', $ogurl);
				$ogurl_part = $ogurl[1];
				$ogurl = 'http:' . $ogurl_part;
				return $ogurl;
			}
			
		}
		return $ogurl;
	}
	
	
	
}





