<?php
/*
 * Plugin main file
 * @package   swdh-mvp
 * @copyright 2023 Muratshaev DOO
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link      https://muratshaev.me/wdh-mvp-plugin/
 *
 * @wordpress-plugin
 * Plugin Name:       SWDH MVP
 * Plugin URI:        https://muratshaev.me/wdh-mvp-plugin/
 * Description:       Plugin for page MVP dev
 * Tested up to:      6.1
 * Requires PHP:      7.3
 * Version:			  1.0
 * Stable tag:        1.0
 * Author:            Yevgeniy Muratshayev
 * Author URI:        https://muratshaev.me/
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       swdh-mvp
 */

/**
 * Add localization
 */
add_action(
    'plugins_loaded',
    function () {
        load_plugin_textdomain('swdh-mvp', false, get_home_url() . '/wp-content/plugins/swdh-mvp/lang');
    }
);

add_action('wp_enqueue_scripts', 'smvp_name_scripts');
/**
 * Add style plugin
 *
 * @retun void
 */
function smvp_name_scripts() {
    wp_enqueue_style('swdtmvp-styles', plugins_url('/css/style.css', __FILE__));
    wp_enqueue_style('swdh-tokenization-ol-styles', plugins_url('/css/owl.carousel.min.css', __FILE__));
    wp_enqueue_style('swdh-tokenization-ol-theme-styles', plugins_url('/css/owl.theme.default.min.css', __FILE__));
    wp_enqueue_script('swdh-tokenization-ol-script', plugins_url() . '/js/owl.carousel.min.js');
}


add_shortcode('swdhmvp', 'swdh_mvp_shortcode');
function swdh_mvp_shortcode($atts) {
    return '';
}
