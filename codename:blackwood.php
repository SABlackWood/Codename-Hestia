<?php
/**
 * Plugin Name
 *
 * @package           Shortcode
 * @author            Blackwood
 * @copyright         BxBMedia
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Blackwood BxB Product Pull
 * Plugin URI:        https://github.com/badwolfvi/blackwood-a24-plugin
 * Description:       The plugin enables an HVAC website to pull products from a custom post type called "hvac-product" in WordPress, based on certain parameters such as product type, manufacturer, rating and price tier. 
 * Version:           20.0.1
 * Version Name:      Conquest
 * Requires at least: 5.7.28
 * Requires PHP:      6.1.9
 * Author:            Blackwood
 * Author URI:        https://bxbmedia.com
 * Text Domain:       Codename:Hestia
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
/*
  ** Shortcode:
      ** [display-products]

  ** $GET Values
      ** FOR CONTACT
        ** First, Last, Phone, Email, Zip

      ** FOR INFORMATION
        ** Site, Home,  Systems, T Furnace-Source, Split-Source

      ** FOR CONDITIONALS
        ** Tier, Type, Rating, Source, Split
*/

//Just for security measures
 if ( ! defined( 'ABSPATH' ) ) {
    die;
  }
  function hestia_enqueue_styles_and_scripts() {
    wp_enqueue_style( 'on-site-grid-styles', plugin_dir_url( __FILE__ ) . 'assets/css/on-site-grid.css' );
    wp_enqueue_style( 'snippet-grid-styles', plugin_dir_url( __FILE__ ) . 'assets/css/snippet-grid.css' );
    wp_enqueue_script( 'split-control-variable', plugin_dir_url( __FILE__ ) . '/assets/js/split-control-variables.js', array(), '1.0', true );
    wp_enqueue_script( 'custom-column-select', plugin_dir_url( __FILE__ ) . '/assets/js/custom-column-select.js', array(), '1.0', true );
    wp_enqueue_script( 'button-overide', plugin_dir_url( __FILE__ ) . '/assets/js/button-overide.js', array(), '1.0', true );
  }
  add_action( 'wp_enqueue_scripts', 'hestia_enqueue_styles_and_scripts' );

require_once( 'display-products.php' );

add_shortcode('display-products', 'display_products');





 