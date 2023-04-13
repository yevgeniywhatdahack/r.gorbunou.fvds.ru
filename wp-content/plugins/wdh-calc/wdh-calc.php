<?php
/*
 * Plugin main file
 * @package   wdhcalc
 * @copyright 2023 Muratshaev DOO
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link      https://muratshaev.me/steptotalplugin/
 *
 * @wordpress-plugin
 * Plugin Name:       WDH Calculator
 * Plugin URI:        https://muratshaev.me/wdhcalc-plugin/
 * Description:       Plugin for step by step calculator for the cost of an service
 * Tested up to:      6.1
 * Requires PHP:      7.3
 * Version:			  1.0
 * Stable tag:        1.0
 * Author:            Yevgeniy Muratshayev
 * Author URI:        https://muratshaev.me/
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       wdhcalc
 */
/**
 * Add localization
 */
add_action(
	'plugins_loaded',
	function () {
		load_plugin_textdomain( 'wdhcalc', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
	}
);

add_action( 'wp_enqueue_scripts', 'wdhcalc_name_scripts' );
/**
 * Add style plugin
 *
 * @retun void
 */
function wdhcalc_name_scripts() {
	wp_enqueue_style( 'wdhcalc-styles', plugins_url( '/css/style.css', __FILE__ ) );
}

/**
 * Add type post WDH Calculator
 *
 * @return void
 */
function wdh_post_create_wdhcalc_posttype() {
	$labels = array(
		'name'               => _x( 'WDH Calculator', 'Type posts WDH Calculator', 'wdhcalc' ),
		'singular_name'      => _x( 'WDH Calculator', 'Type posts WDH Calculator', 'wdhcalc' ),
		'menu_name'          => __( 'WDH Calculator', 'wdhcalc' ),
		'all_items'          => __( 'All Calcs', 'wdhcalc' ),
		'view_item'          => __( 'Look WDH Calculator', 'wdhcalc' ),
		'add_new_item'       => __( 'Add new WDH Calculator', 'wdhcalc' ),
		'add_new'            => __( 'Add new', 'wdhcalc' ),
		'edit_item'          => __( 'Edit WDH Calulator', 'wdhcalc' ),
		'update_item'        => __( 'Update WDH Calculator', 'wdhcalc' ),
		'search_items'       => __( 'Search Calculator', 'wdhcalc' ),
		'not_found'          => __( 'Not found', 'wdhcalc' ),
		'not_found_in_trash' => __( 'Not found in trash', 'wdhcalc' ),
	);
	$args   = array(
		'label'               => __( 'wdhcalc', 'wdhcalc' ),
		'description'         => __( 'WDH Calculator', 'wdhcalc' ),
		'labels'              => $labels,
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'page-attributes',
			'comments',
			'revisions',
			'custom-fields',
		),
		'taxonomies'          => array( 'wdhcalc' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-welcome-widgets-menus',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'wdhcalc', $args );
}
add_action( 'init', 'wdh_post_create_wdhcalc_posttype', 0 );


/**
 * Add type post WDH results forms
 *
 * @return void
 */
function wdh_post_create_wdhresults_posttype() {
	$labels = array(
		'name'               => _x( 'WDH Results', 'Type posts WDH Results', 'wdhcalc' ),
		'singular_name'      => _x( 'WDH Results', 'Type posts WDH Results', 'wdhcalc' ),
		'menu_name'          => __( 'WDH Results', 'wdhcalc' ),
		'all_items'          => __( 'All Results', 'wdhcalc' ),
		'view_item'          => __( 'Look WDH Results', 'wdhcalc' ),
		'add_new_item'       => __( 'Add new WDH Form', 'wdhcalc' ),
		'add_new'            => __( 'Add new', 'wdhcalc' ),
		'edit_item'          => __( 'Edit WDH Results', 'wdhcalc' ),
		'update_item'        => __( 'Update WDH Results', 'wdhcalc' ),
		'search_items'       => __( 'Search Results', 'wdhcalc' ),
		'not_found'          => __( 'Not found', 'wdhcalc' ),
		'not_found_in_trash' => __( 'Not found in trash', 'wdhcalc' ),
	);
	$args   = array(
		'label'               => __( 'wdhquestions', 'wdhcalc' ),
		'description'         => __( 'WDH Results', 'wdhcalc' ),
		'labels'              => $labels,
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'page-attributes',
			'comments',
			'revisions',
			'custom-fields',
		),
		'taxonomies'          => array( 'wdhresults' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 23,
		'menu_icon'           => 'dashicons-format-aside',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'wdhresults', $args );
}
add_action( 'init', 'wdh_post_create_wdhresults_posttype', 0 );

/**
 * Function for create type post WDH types
 *
 * @return void
 */
function wdh_post_create_wdhrtypes_posttype() {
	$labels = array(
		'name'               => _x( 'WDH types', 'Type posts WDH types', 'wdhcalc' ),
		'singular_name'      => _x( 'WDH types', 'Type posts WDH types', 'wdhcalc' ),
		'menu_name'          => __( 'WDH types', 'wdhcalc' ),
		'all_items'          => __( 'All types', 'wdhcalc' ),
		'view_item'          => __( 'Look WDH types', 'wdhcalc' ),
		'add_new_item'       => __( 'Add new WDH Form', 'wdhcalc' ),
		'add_new'            => __( 'Add new', 'wdhcalc' ),
		'edit_item'          => __( 'Edit WDH types', 'wdhcalc' ),
		'update_item'        => __( 'Update WDH types', 'wdhcalc' ),
		'search_items'       => __( 'Search types', 'wdhcalc' ),
		'not_found'          => __( 'Not found', 'wdhcalc' ),
		'not_found_in_trash' => __( 'Not found in trash', 'wdhcalc' ),
	);
	$args   = array(
		'label'               => __( 'wdhquestions', 'wdhcalc' ),
		'description'         => __( 'WDH types', 'wdhcalc' ),
		'labels'              => $labels,
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'page-attributes',
			'comments',
			'revisions',
			'custom-fields',
		),
		'taxonomies'          => array( 'wdhtypes' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 24,
		'menu_icon'           => 'dashicons-tide',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'wdhtypes', $args );
}
add_action( 'init', 'wdh_post_create_wdhrtypes_posttype', 0 );

/**
 * Function create type post WDH project
 *
 * @return void
 */
function wdh_post_create_wdh_project_posttype() {
	$labels = array(
		'name'               => _x( 'WDH project', 'Type posts WDH project', 'wdhcalc' ),
		'singular_name'      => _x( 'WDH project', 'Type posts WDH project', 'wdhcalc' ),
		'menu_name'          => __( 'WDH project', 'wdhcalc' ),
		'all_items'          => __( 'All project', 'wdhcalc' ),
		'view_item'          => __( 'Look WDH project', 'wdhcalc' ),
		'add_new_item'       => __( 'Add new WDH Form', 'wdhcalc' ),
		'add_new'            => __( 'Add new', 'wdhcalc' ),
		'edit_item'          => __( 'Edit WDH project', 'wdhcalc' ),
		'update_item'        => __( 'Update WDH project', 'wdhcalc' ),
		'search_items'       => __( 'Search project', 'wdhcalc' ),
		'not_found'          => __( 'Not found', 'wdhcalc' ),
		'not_found_in_trash' => __( 'Not found in trash', 'wdhcalc' ),
	);
	$args   = array(
		'label'               => __( 'wdhquestions', 'wdhcalc' ),
		'description'         => __( 'WDH project', 'wdhcalc' ),
		'labels'              => $labels,
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'page-attributes',
			'comments',
			'revisions',
			'custom-fields',
		),
		'taxonomies'          => array( 'wdhproject' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-rest-api',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'wdhproject', $args );
}
add_action( 'init', 'wdh_post_create_wdh_project_posttype', 0 );


/**
 * Function create type post WDH team
 *
 * @return void
 */
function wdh_post_create_wdh_team_posttype() {
	$labels = array(
		'name'               => _x( 'WDH team', 'Type posts WDH team', 'wdhcalc' ),
		'singular_name'      => _x( 'WDH team', 'Type posts WDH team', 'wdhcalc' ),
		'menu_name'          => __( 'WDH team', 'wdhcalc' ),
		'all_items'          => __( 'All team', 'wdhcalc' ),
		'view_item'          => __( 'Look WDH team', 'wdhcalc' ),
		'add_new_item'       => __( 'Add new WDH Form', 'wdhcalc' ),
		'add_new'            => __( 'Add new', 'wdhcalc' ),
		'edit_item'          => __( 'Edit WDH team', 'wdhcalc' ),
		'update_item'        => __( 'Update WDH team', 'wdhcalc' ),
		'search_items'       => __( 'Search team', 'wdhcalc' ),
		'not_found'          => __( 'Not found', 'wdhcalc' ),
		'not_found_in_trash' => __( 'Not found in trash', 'wdhcalc' ),
	);
	$args   = array(
		'label'               => __( 'wdhquestions', 'wdhcalc' ),
		'description'         => __( 'WDH team', 'wdhcalc' ),
		'labels'              => $labels,
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'page-attributes',
			'comments',
			'revisions',
			'custom-fields',
		),
		'taxonomies'          => array( 'wdhteam' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 26,
		'menu_icon'           => 'dashicons-buddicons-buddypress-logo',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'wdhteam', $args );
}
add_action( 'init', 'wdh_post_create_wdh_team_posttype', 0 );

/**
 * Function create type post WDH reports
 *
 * @return void
 */
function wdh_post_create_wdh_reports_posttype() {
	$labels = array(
		'name'               => _x( 'WDH reports', 'Type posts WDH reports', 'wdhcalc' ),
		'singular_name'      => _x( 'WDH reports', 'Type posts WDH reports', 'wdhcalc' ),
		'menu_name'          => __( 'WDH reports', 'wdhcalc' ),
		'all_items'          => __( 'All reports', 'wdhcalc' ),
		'view_item'          => __( 'Look WDH reports', 'wdhcalc' ),
		'add_new_item'       => __( 'Add new WDH Form', 'wdhcalc' ),
		'add_new'            => __( 'Add new', 'wdhcalc' ),
		'edit_item'          => __( 'Edit WDH reports', 'wdhcalc' ),
		'update_item'        => __( 'Update WDH reports', 'wdhcalc' ),
		'search_items'       => __( 'Search reports', 'wdhcalc' ),
		'not_found'          => __( 'Not found', 'wdhcalc' ),
		'not_found_in_trash' => __( 'Not found in trash', 'wdhcalc' ),
	);
	$args   = array(
		'label'               => __( 'wdhquestions', 'wdhcalc' ),
		'description'         => __( 'WDH reports', 'wdhcalc' ),
		'labels'              => $labels,
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'page-attributes',
			'comments',
			'revisions',
			'custom-fields',
		),
		'taxonomies'          => array( 'wdhreports' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 27,
		'menu_icon'           => 'dashicons-editor-table',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'wdhreports', $args );
}
add_action( 'init', 'wdh_post_create_wdh_reports_posttype', 0 );

/**
 * Function create type post WDH specialties
 *
 * @return void
 */
function wdh_post_create_wdh_specialties_posttype() {
	$labels = array(
		'name'               => _x( 'WDH specialties', 'Type posts WDH specialties', 'wdhcalc' ),
		'singular_name'      => _x( 'WDH specialties', 'Type posts WDH specialties', 'wdhcalc' ),
		'menu_name'          => __( 'WDH specialties', 'wdhcalc' ),
		'all_items'          => __( 'All specialties', 'wdhcalc' ),
		'view_item'          => __( 'Look WDH specialties', 'wdhcalc' ),
		'add_new_item'       => __( 'Add new WDH Form', 'wdhcalc' ),
		'add_new'            => __( 'Add new', 'wdhcalc' ),
		'edit_item'          => __( 'Edit WDH specialties', 'wdhcalc' ),
		'update_item'        => __( 'Update WDH specialties', 'wdhcalc' ),
		'search_items'       => __( 'Search specialties', 'wdhcalc' ),
		'not_found'          => __( 'Not found', 'wdhcalc' ),
		'not_found_in_trash' => __( 'Not found in trash', 'wdhcalc' ),
	);
	$args   = array(
		'label'               => __( 'wdhquestions', 'wdhcalc' ),
		'description'         => __( 'WDH specialties', 'wdhcalc' ),
		'labels'              => $labels,
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'page-attributes',
			'comments',
			'revisions',
			'custom-fields',
		),
		'taxonomies'          => array( 'wdhspecialties' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 28,
		'menu_icon'           => 'dashicons-format-gallery',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'wdhspecialties', $args );
}
add_action( 'init', 'wdh_post_create_wdh_specialties_posttype', 0 );

/** Ajax functions
 *
 * @return void
 */
add_action( 'wp_ajax_wdh_upd', 'wdh_ajax_upd_callback' );
add_action( 'wp_ajax_nopriv_wdh_upd', 'wdh_ajax_upd_callback' );

function wdh_ajax_upd_callback() {
	$id                = $_POST['id'];
	$wdh_id            = $_POST['id_post'];
	$ppost             = get_post( $wdh_id );
	$title_question    = $_POST['title'];
	$text_for_question = $_POST['text'];
	$name_title        = 'title_question_' . $id;
	$name_text         = 'text_for_question_' . $id;
	update_post_meta( $wdh_id, $name_title, $title_question );
	update_post_meta( $wdh_id, $name_text, $text_for_question );
}
