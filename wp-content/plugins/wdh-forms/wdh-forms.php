<?php
/*
 * Plugin main file
 * @package   wdh-forms
 * @copyright 2023 Muratshaev DOO
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link      https://muratshaev.me/wdh-poll-plugin/
 *
 * @wordpress-plugin
 * Plugin Name:       WDH Forms
 * Plugin URI:        https://muratshaev.me/wdh-forms-plugin/
 * Description:       Plugin for forms login, sign for WDH
 * Tested up to:      6.1
 * Requires PHP:      7.3
 * Version:			  1.0
 * Stable tag:        1.0
 * Author:            Yevgeniy Muratshayev
 * Author URI:        https://muratshaev.me/
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       wdh-calc
 */


/**
 * Add localization
 */


add_action(
	'plugins_loaded',
	function () {
		load_plugin_textdomain( 'wdh-calc', false, get_home_url() . '/wp-content/plugins/wdh-calc/lang' );
	}
);

/**
 * Add style plugin
 */
add_action( 'wp_enqueue_scripts', 'wdhforms_name_scripts' );
function wdhforms_name_scripts() {
	wp_enqueue_script( 'wdh-form-script', plugins_url() . '/wdh-forms/js/script.js' );
	wp_enqueue_script( 'wdh-mask', 'https:// unpkg.com/imask' );
}

class Wdh_Form {

	public static function wdh_first_form() {
		$form = '';
		$form = $form . '<div id="wdh-content">';
		$form = $form . '<div class="container"style="margin-top: 300px">';
		$form = $form . '<div class="row">';
		$form = $form . '<div class="col-lg-6" style="margin: auto;">';
		$form = $form . '<div id="loader">';
		$form = $form . '<div class="loader-text">' . __( 'Processing responses...', 'wdh-calc' ) . '</div>';
		$form = $form . '<div class="wrap-loader"></div>';
		$form = $form . '<div id="zebra"></div>';
		$form = $form . '</div>';
		$form = $form . '</div>';
		$form = $form . '</div>';
		$form = $form . '</div>';
		$form = $form . '</div>';
		return $form;
	}

	public static function wdh_sms_form( $phone ) {
		$form = '';
		$form = $form . '<div class="container" style="background-color: #fff; margin-top: 60px">';
		$form = $form . '<div class="row justify-content-md-center">';
		$form = $form . '<div class="col-lg-8">';
		$form = $form . '<div class="sign-form" id="sign-form">';
		$form = $form . '<form action="' . get_home_url() . '/checkcode/" name="login-form" method="post">';
		$form = $form . '<div class="row text-center login-form-title">';
		$form = $form . '<div class="col-lg-12">';
		$form = $form . '' . __( 'Sign up', 'wdh-cacl' );
		$form = $form . '</div>';
		$form = $form . '</div>';
		$form = $form . '<div class="row text-center login-form-txt">';
		$form = $form . '<div class="col-lg-12">';
		$form = $form . '<p>';

		$form = $form . '' . __( 'Enter the code we sent to your number ', 'wdh-calc' );
		if ( $phone == '' ) {
			$form = $form . '+90 000 000 00 00';
		} else {
			$form = $form . '' . $phone;
		}
		$form = $form . '</p>';
		$form = $form . '</div>';
		$form = $form . '</div>';
		$form = $form . '<div class="row login-form-input">';
		$form = $form . '<div class="col-lg-12 text-center">';
		$form = $form . '<input id="phone" type="text" name="phone" data-phone-pattern = "____" class="sms-code" placeholder="____" />';
		$form = $form . '<input type="hidden" name="tel" value="' . $phone . '" id="tel">';
		$form = $form . '</div>';
		$form = $form . '</div>';
		$form = $form . '<div class="row row-login-form-button">';
		$form = $form . '<div class="col-lg-12 text-center">';
		$form = $form . '<a href="#" class="resend">' . __( 'Resend', 'wdh-calc' ) . '</a>';
		$form = $form . '</div>';
		$form = $form . '</div>';
		$form = $form . '</form>';
		$form = $form . '<div class="bottom-form"></div>';
		$form = $form . '</div>';
		$form = $form . '</div>';
		$form = $form . '</div>';
		$form = $form . '</div>';

		return $form;
	}
}

/** Ajax functions
 *
 * @return void
 */
add_action( 'wp_ajax_wdh_check_code', 'wdh_check_code_callback' );
add_action( 'wp_ajax_nopriv_wdh_check_code', 'wdh_check_code_callback' );

function wdh_check_code_callback() {
	$code = $_POST['code'];
	$tel  = $_POST['tel'];
	$tel  = str_replace( '+', '', $tel );
	if ( username_exists( $tel ) ) {
		$this_user    = get_user_by( 'login', $tel );
		$this_user_id = $this_user->ID;
		$pin          = get_user_meta( $this_user_id, 'pin', true );
		if ( $code == $pin ) {
			echo 'true';
			update_user_meta( $this_user_id, 'active', 'yes' );
			update_user_meta( $this_user_id, 'pin', '' );
			wp_clear_auth_cookie();
			wp_set_auth_cookie( $this_user_id, true );
		} else {
			echo 'false pin=' . $pin . ' code=' . $code;
		}
	}
}


add_action( 'wp_ajax_wdh_create_user', 'wdh_create_user_callback' );
add_action( 'wp_ajax_nopriv_wdh_create_user', 'wdh_create_user_callback' );
function wdh_create_user_callback() {
	$userphone = sanitize_text_field( $_POST['userphone'] );
	$email     = sanitize_email( $_POST['email'] );
	$budget    = sanitize_text_field( $_POST['budget'] );
	$platform  = sanitize_text_field( $_POST['platform'] );
	$userteam  = sanitize_text_field( $_POST['userteam'] );
	$userdates = sanitize_text_field( $_POST['userdates'] );
	$auth      = sanitize_text_field( $_POST['auth'] );

	$password = wp_generate_password( 12, false );
	$username = $userphone;

	// Check user
	$usercheck = 0;
	$user_id   = 0;
	if ( username_exists( $username ) ) {
		$usercheck = 1;
		$this_user = get_user_by( 'login', $username );
		$user_id   = $this_user->ID;
	}
	if ( email_exists( $email ) ) {
		if ( $user_id == 0 ) {
			$this_user = get_user_by( 'email', $email );
			$user_id   = $this_user->ID;
		}
		$usercheck = 1;
	}
	$pin = rand( 1000, 9999 );
	if ( $usercheck == 0 ) {

		$user_id = wp_create_user( $username, $password, $email );
		update_user_meta( $user_id, 'telephone', $userphone );
		update_user_meta( $user_id, 'active', 'no' );
		update_user_meta( $user_id, 'pin', $pin );

	} else {
		if ( $auth == 0 ) {
			update_user_meta( $user_id, 'pin', $pin );
		}
	}

	// create project
	// platform and team
	$pl         = explode( ', ', $platform );
	$pl_count   = count( $pl );
	$teams      = array();
	$count_team = 0;

	/**
	 * condition for platform
	 */

	for ( $i = 0; $i < $pl_count; $i++ ) {
		// Mobile iOS, Mobile Android, Crossplatform, Desktop, Middleware, IoT, Web
		if ( $pl[ $i ] == 'Mobile iOS' ) {
			$teams[ $count_team ] = '10076';
		}
		if ( $pl[ $i ] == 'Mobile Android' ) {
			$teams[ $count_team ] = '10067';
		}
		if ( $pl[ $i ] == 'Crossplatform' ) {
			$teams[ $count_team ] = '10070';
		}
		if ( $pl[ $i ] == 'Desktop' ) {
			$teams[ $count_team ] = '10072';
		}
		if ( $pl[ $i ] == 'Middleware' ) {
			$teams[ $count_team ] = '10074';
		}
		if ( $pl[ $i ] == 'IoT' ) {
			$teams[ $count_team ] = '10078';
		}
		if ( $pl[ $i ] == 'Web' ) {
			$teams[ $count_team ] = '10080';
		}
		$count_team++;
	}

	// Base setup
	/*
	1 TL - Tech lead 10067
	1 BE -  Back-end developer 10070
	1 FE - Front-end developer 10072
	1 UX - User experience and graphic interface designer 10074
	1 BA - Business and/or system analyst 10076
	1 PM - project manager 10176
	1 XQA -  manual quality assurance engineer 10178
	1 DevOps - System integration engineer, system infrustructure administrator, system security engineer 10180
	 */
	$base_setup_teams    = array( 10067, 10070, 10072, 10074, 10076, 10176, 10178, 10180 );
	$base_setup_quantity = '1,1,1,1,1,1,1,1';

	$content = 'User Team comment: ' . $userteam . ' Platform: ' . $platform . ' Count Team: ' . $count_team . ' Teams ' . implode( ',', $teams );

	// Basic Setup
	$post_data = array(
		'post_title'   => 'Project ' . $userphone,
		'post_status'  => 'publish',
		'post_type'    => 'wdhproject',
		'post_content' => $content,
		'post_author'  => $user_id,
	);
	$post_id   = wp_insert_post( $post_data, true );
	echo $post_id;
	update_post_meta( $post_id, 'owner', $user_id );
	update_post_meta( $post_id, 'stages', 'Start' );
	update_post_meta( $post_id, 'current_status', 'Waiting' );
	update_post_meta( $post_id, 'date_and_stages', $userdates );
	update_post_meta( $post_id, 'days_until_the_release', 90 ); // base setup

	// update_post_meta( $post_id, 'team', $teams );
	update_post_meta( $post_id, 'team', $base_setup_teams );
	update_post_meta( $post_id, 'quantity_staff', $base_setup_quantity );
	update_post_meta( $post_id, 'budget', $budget );
	update_post_meta( $post_id, 'budget_expenses', 0 );

	// send sms

	/*
	require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';

	$sid = "AC863acb2f35ba737c892d21dcea6e5e0d"; // Your Account SID from https://console.twilio.com
	$token = "cfe505942ee471c1c7a9af5a6f05169d"; // Your Auth Token from https://console.twilio.com
	$client = new Twilio\Rest\Client($sid, $token);

	// Use the Client to make requests to the Twilio REST API
	$client->messages->create(
	// The number you'd like to send the message to
	'+15558675309',
	[
		// A Twilio phone number you purchased at https://console.twilio.com
		'from' => '+15017250604',
		// The body of the text message you'd like to send
		'body' => "Hey Jenny! Good luck on the bar exam!"
	]
	);
	*/

	// require 'https://r.gorbunou.fvds.ru/wp-content/plugins/wdh-forms/twilio-php-main/src/Twilio/autoload.php';
	require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';
	// $userphone = '+385915297770';

	$sid = 'AC863acb2f35ba737c892d21dcea6e5e0d'; // Your Account SID from https://console.twilio.com
	// $token  = 'cfe505942ee471c1c7a9af5a6f05169d'; // Your Auth Token from https://console.twilio.com
	$token = 'c73860326e0b48aa3954f459ddd94c68'; // Your Auth Token from https://console.twilio.com

	if ( $auth == 0 ) {
		$client = new Twilio\Rest\Client( $sid, $token );

		$client->messages->create(
		// The number you'd like to send the message to
			$userphone,
			array(
				// A Twilio phone number you purchased at https://console.twilio.com
				'from' => '+15139515594',
				// The body of the text message you'd like to send
				'body' => 'Your PIN: ' . $pin,
			)
		);
	}

}
add_action( 'wp_ajax_wdh_sendnewsms', 'wdh_sendnewsms_callback' );
add_action( 'wp_ajax_nopriv_wdh_sendnewsms', 'wdh_sendnewsms_callback' );
function wdh_sendnewsms_callback() {
	$userphone = sanitize_text_field( $_REQUEST['userphone'] );
	if ( username_exists( $userphone ) ) {
		$this_user = get_user_by( 'login', $userphone );
		$user_id   = $this_user->ID;
		$pin       = rand( 1000, 9999 );
		update_user_meta( $user_id, 'pin', $pin );
		require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';

		$sid = 'AC863acb2f35ba737c892d21dcea6e5e0d'; // Your Account SID from https://console.twilio.com
		// $token  = 'cfe505942ee471c1c7a9af5a6f05169d'; // Your Auth Token from https://console.twilio.com
		$token  = 'c73860326e0b48aa3954f459ddd94c68'; // Your Auth Token from https://console.twilio.com
		$client = new Twilio\Rest\Client( $sid, $token );

		$client->messages->create(
		// The number you'd like to send the message to
			$userphone,
			array(
				// A Twilio phone number you purchased at https://console.twilio.com
				'from' => '+15139515594',
				// The body of the text message you'd like to send
				'body' => 'Your PIN: ' . $pin,
			)
		);
	}
}

add_shortcode( 'wdhforms', 'wdh_forms_shortcode' );

function wdh_forms_shortcode( $atts ) {
	global $post;
	global $user;
	$slug = $post->post_name;
	$txt  = '<style>
	.container-wrap{
		background: #F0F0F9 !important;
	}
	#top{
		background: #fff !important;
	}
	input[type="button"]{
		border-radius: 6px !important;
	}
	@media (min-width: 320px) {
		.container{
			min-width: 100%;
		}
	}
	@media (min-width: 768px) {
		.container{
			min-width: 100%;
		}
	}
	@media (min-width: 768px) {
		.container{
			min-width: auto;
		}
	}
	</style>';

	$mod = $atts['mod'];

		$this_user = wp_get_current_user();
		$user_id   = $this_user->ID;

	if ( isset( $_REQUEST['phone'] ) ) {
		$phone = sanitize_text_field( $_REQUEST['phone'] );
		$phone = str_replace( ' ', '', $phone );
		$phone = str_replace( '-', '', $phone );
		$phone = str_replace( '(', '', $phone );
		$phone = str_replace( ')', '', $phone );
		$phone = str_replace( '_', '', $phone );
		$phone = str_replace( '.', '', $phone );
		$phone = str_replace( ',', '', $phone );
	} else {
		$phone = '';
	}
		$budget     = sanitize_text_field( $_REQUEST['budget'] );
		$budget_val = 0;
	if ( $budget == 'Under $50 000' ) {
		$budget_val = 50000;
	}
	if ( $budget == '$50 000 - $100 000' ) {
		$budget_val = 100000;
	}
	if ( $budget == '$100 000 - $200 000' ) {
		$budget_val = 200000;
	}
	if ( $budget == '$100 000 +' ) {
		$budget_val = 300000;
	}
	$budget_val   = 50000;
		$platform = sanitize_text_field( $_REQUEST['platform'] );
		$email    = sanitize_email( $_REQUEST['email'] );

		$txt = $txt . '<div class="hidden-form">';
		$txt = $txt . '<form name="h-form">';
		$txt = $txt . '<input type="hidden" name="phone" value="' . $phone . '" id="phone">';
		$txt = $txt . '<input type="hidden" name="budget" value="' . $budget_val . '" id="budget">';
		$txt = $txt . '<input type="hidden" name="platform" value="' . $platform . '" id="platform">';
		$txt = $txt . '<input type="hidden" name="email" value="' . $email . '" id="email">';
		$txt = $txt . '<input type="hidden" name="userteam" id="userteam">';
		$txt = $txt . '<input type="hidden" name="userdates" id="userdates">';
		$txt = $txt . '<input type="hidden" name="project" id="project">';
	if ( is_user_logged_in() ) {
		$auth = 1;
	} else {
		$auth = 0;
	}
		$txt = $txt . '<input type="hidden" name="auth" id="auth" value="' . $auth . '">';
		$txt = $txt . '</form>';
		$txt = $txt . '</div>';

		// $txt = Wdh_Form::wdh_sms_form( $phone );
		$txt = $txt . '' . Wdh_Form::wdh_first_form();

	return $txt;
}
