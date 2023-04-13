<?php
/*
 * Plugin main file
 * @package   wdh-poll
 * @copyright 2023 Muratshaev DOO
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link      https://muratshaev.me/wdh-poll-plugin/
 *
 * @wordpress-plugin
 * Plugin Name:       WDH Poll
 * Plugin URI:        https://muratshaev.me/wdh-poll-plugin/
 * Description:       Plugin for view page poll for WDH
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
		load_plugin_textdomain('wdh-calc', false, get_home_url() . '/wp-content/plugins/wdh-calc/lang');
	}
);
/**
 * Add style plugin
 */
add_action('wp_enqueue_scripts', 'wdh_poll_name_scripts');
function wdh_poll_name_scripts() {
	wp_enqueue_style('wdh-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css');
	wp_enqueue_script('wdh-form-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js');
	wp_enqueue_script('wdh-formjs-script', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js');
	wp_enqueue_script('wdh-bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js');
}

add_shortcode('wdhpoll', 'wdh_poll_shortcode');

function wdh_poll_shortcode($atts) {
	global $post;
	global $user;

	if (is_user_logged_in()) {
		$this_user    = wp_get_current_user();
		$post_id      = sanitize_text_field($_REQUEST['post_id']);
		$this_post    = get_post($post_id);
		$user_post    = get_post_meta($post_id, 'user', true);
		$this_user_id = $this_user->ID;
		if ($this_user_id == $user_post) {

			$title_question_1    = get_post_meta($post_id, 'title_question_1', true);
			$text_for_question_1 = get_post_meta($post_id, 'text_for_question_1', true);
			$title_question_2    = get_post_meta($post_id, 'title_question_2', true);
			$text_for_question_2 = get_post_meta($post_id, 'text_for_question_2', true);
			$title_question_3    = get_post_meta($post_id, 'title_question_3', true);
			$text_for_question_3 = get_post_meta($post_id, 'text_for_question_3', true);
			$title_question_4    = get_post_meta($post_id, 'title_question_4', true);
			$text_for_question_4 = get_post_meta($post_id, 'text_for_question_4', true);
			$title_question_5    = get_post_meta($post_id, 'title_question_5', true);
			$text_for_question_5 = get_post_meta($post_id, 'text_for_question_5', true);
			$title_question_6    = get_post_meta($post_id, 'title_question_6', true);
			$text_for_question_6 = get_post_meta($post_id, 'text_for_question_6', true);
			$total               = get_post_meta($post_id, 'total', true);

			$txt = '<div class="container-fluid wdh-container-fluid">';
			$txt = $txt . '<div class="container">';
			$txt = $txt . '<div class="row">';
			$txt = $txt . '<div class="col-lg-12">';
			$txt = $txt . '<div id="whd-vertical-wrap">';
			$txt = $txt . '<div class="whd-vertical"></div>';
			$txt = $txt . '<div type="button" class="wdh-quest-top" id="wdh-quest01" data-bs-toggle="modal" data-bs-target="#staticQ01">';
			$txt = $txt . '<h4>' . $title_question_1 . '</h4>';
			$txt = $txt . '<p>' . $text_for_question_1 . '</p>';
			$txt = $txt . '</div>';
			$txt = $txt . '<!-- Modal -->';
			$txt = $txt . '<div class="modal fade" id="staticQ01" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQ01Label" aria-hidden="true">';
			$txt = $txt . '<div class="modal-dialog">';
			$txt = $txt . '<div class="modal-content">';
			$txt = $txt . '<form action="" name="send01Form" method="post">';
			$txt = $txt . '<div class="modal-header">';
			$txt = $txt . '<h1 class="modal-title fs-5" id="staticQ01Label">' . __('Edit quest', 'wdh-calc') . '</h1>';
			$txt = $txt . '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-body">';
			$txt = $txt . '<input type="text" name="title_question_1" id="title_question_1" class="form-control" value="' . $title_question_1 . '">';
			$txt = $txt . '<textarea name="text_for_question_1" id="text_for_question_1" cols="30" rows="10" class="form-control">' . $text_for_question_1 . '</textarea>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-footer">';
			$txt = $txt . '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . __('Close', 'wwdh - calc') . '</button>';
			$txt = $txt . '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveQuest(1);">' . __('Update', 'wdh - calc') . '</button>';
			$txt = $txt . '</div>';
			$txt = $txt . '</form>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="const01"></div>';
			$txt = $txt . '<button type="button" class="wdh-space-box02" id="wdh-quest02" data-bs-toggle="modal" data-bs-target="#staticQ02">';
			$txt = $txt . '<h5>' . $title_question_2 . '</h5>';
			$txt = $txt . '' . $text_for_question_2;
			$txt = $txt . '</button>';
			$txt = $txt . '<!-- Modal -->';
			$txt = $txt . '<div class="modal fade" id="staticQ02" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQ02Label" aria-hidden="true">';
			$txt = $txt . '<div class="modal-dialog">';
			$txt = $txt . '<div class="modal-content">';
			$txt = $txt . '<form action="">';
			$txt = $txt . '<div class="modal-header">';
			$txt = $txt . '<h1 class="modal-title fs-5" id="staticQ2Label">' . __('Edit quest', 'wdh - calc') . '</h1>';
			$txt = $txt . '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-body">';
			$txt = $txt . '<input type="text" name="title_question_2" id="title_question_2" class="form-control" value="' . $title_question_2 . '">';
			$txt = $txt . '<textarea name="text_for_question_2" id="text_for_question_2" cols="30" rows="10" class="form-control">' . $text_for_question_2 . '</textarea>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-footer">';
			$txt = $txt . '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . __('Close', 'wwdh - calc') . '</button>';
			$txt = $txt . '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveQuest(2);">' . __('Update', 'wdh - calc') . '</button>';
			$txt = $txt . '</div>';
			$txt = $txt . '</form>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="const02"></div>';
			$txt = $txt . '<button type="button" class="wdh-space-box03" id="wdh-quest03" data-bs-toggle="modal" data-bs-target="#staticQ03">';
			$txt = $txt . '<h5>' . $title_question_3 . '</h5>';
			$txt = $txt . '' . $text_for_question_3;
			$txt = $txt . '</button>';
			$txt = $txt . '<!-- Modal -->';
			$txt = $txt . '<div class="modal fade" id="staticQ03" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQ03Label" aria-hidden="true">';
			$txt = $txt . '<div class="modal-dialog">';
			$txt = $txt . '<div class="modal-content">';
			$txt = $txt . '<form action="">';
			$txt = $txt . '<div class="modal-header">';
			$txt = $txt . '<h1 class="modal-title fs-5" id="staticQ03Label">' . __('Edit quest', 'wdh - calc') . '</h1>';
			$txt = $txt . '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-body">';
			$txt = $txt . '<input type="text" name="title_question_3" id="title_question_3" class="form-control" value="' . $title_question_3 . '">';
			$txt = $txt . '<textarea name="text_for_question_3" id="text_for_question_3" cols="30" rows="10" class="form-control">' . $text_for_question_3 . '</textarea>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-footer">';
			$txt = $txt . '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . __('Close', 'wwdh - calc') . '</button>';
			$txt = $txt . '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveQuest(3);">' . __('Update', 'wdh - calc') . '</button>';
			$txt = $txt . '</div>';
			$txt = $txt . '</form>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="const03"></div>';
			$txt = $txt . '<button type="button" class="wdh-space-box04" id="wdh-quest04" data-bs-toggle="modal" data-bs-target="#staticQ04">';
			$txt = $txt . '<h5>' . $title_question_4 . '</h5>';
			$txt = $txt . '' . $text_for_question_4;
			$txt = $txt . '</button>';
			$txt = $txt . '<!-- Modal -->';
			$txt = $txt . '<div class="modal fade" id="staticQ04" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQ04Label" aria-hidden="true">';
			$txt = $txt . '<div class="modal-dialog">';
			$txt = $txt . '<div class="modal-content">';
			$txt = $txt . '<form action="">';
			$txt = $txt . '<div class="modal-header">';
			$txt = $txt . '<h1 class="modal-title fs-5" id="staticQ04Label">' . __('Edit quest', 'wdh - calc') . '</h1>';
			$txt = $txt . '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-body">';
			$txt = $txt . '<input type="text" name="title_question_4" id="title_question_4" class="form-control" value="' . $title_question_4 . '">';
			$txt = $txt . '<textarea name="text_for_question_4" id="text_for_question_4" cols="30" rows="10" class="form-control">' . $text_for_question_4 . '</textarea>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-footer">';
			$txt = $txt . '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . __('Close', 'wwdh - calc') . '</button>';
			$txt = $txt . '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveQuest(4);">' . __('Update', 'wdh - calc') . '</button>';
			$txt = $txt . '</div>';
			$txt = $txt . '</form>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="const04"></div>';
			$txt = $txt . '<button type="button" class="wdh-space-box05" id="wdh-quest05" data-bs-toggle="modal" data-bs-target="#staticQ05">';
			$txt = $txt . '<h5>' . $title_question_5 . '</h5>';
			$txt = $txt . '' . $text_for_question_5;
			$txt = $txt . '</button>';
			$txt = $txt . '<!-- Modal -->';
			$txt = $txt . '<div class="modal fade" id="staticQ05" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQ05Label" aria-hidden="true">';
			$txt = $txt . '<div class="modal-dialog">';
			$txt = $txt . '<div class="modal-content">';
			$txt = $txt . '<form action="">';
			$txt = $txt . '<div class="modal-header">';
			$txt = $txt . '<h1 class="modal-title fs-5" id="staticQ05Label">' . __('Edit quest', 'wdh - calc') . '</h1>';
			$txt = $txt . '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-body">';
			$txt = $txt . '<input type="text" name="title_question_5" id="title_question_5" class="form-control" value="' . $title_question_5 . '">';
			$txt = $txt . '<textarea name="text_for_question_5" id="text_for_question_5" cols="30" rows="10" class="form-control">' . $text_for_question_5 . '</textarea>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-footer">';
			$txt = $txt . '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . __('Close', 'wwdh - calc') . '</button>';
			$txt = $txt . '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveQuest(5);">' . __('Update', 'wdh - calc') . '</button>';
			$txt = $txt . '</div>';
			$txt = $txt . '</form>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="const05"></div>';
			$txt = $txt . '<button type="button" class="wdh-space-box06" id="wdh-quest06" data-bs-toggle="modal" data-bs-target="#staticQ06">';
			$txt = $txt . '<h5>' . $title_question_6 . '</h5>';
			$txt = $txt . '' . $text_for_question_6;
			$txt = $txt . '</button>';
			$txt = $txt . '<!-- Modal -->';
			$txt = $txt . '<div class="modal fade" id="staticQ06" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQ06Label" aria-hidden="true">';
			$txt = $txt . '<div class="modal-dialog">';
			$txt = $txt . '<div class="modal-content">';
			$txt = $txt . '<form action="" name="sendForm" method="post">';
			$txt = $txt . '<div class="modal-header">';
			$txt = $txt . '<h1 class="modal-title fs-5" id="staticQ06Label">' . __('Edit quest', 'wdh - calc') . '</h1>';
			$txt = $txt . '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-body">';
			$txt = $txt . '<input type="text" name="title_question_6" id="title_question_6" class="form-control" value="' . $title_question_6 . '">';
			$txt = $txt . '<textarea name="text_for_question_6" id="text_for_question_6" cols="30" rows="10" class="form-control">' . $text_for_question_6 . '</textarea>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="modal-footer">';
			$txt = $txt . '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . __('Close', 'wwdh - calc') . '</button>';
			$txt = $txt . '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveQuest(6);">' . __('Update', 'wdh - calc') . '</button>';
			$txt = $txt . '</div>';
			$txt = $txt . '</form>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="const06"></div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<script>';
			$txt = $txt . 'function saveQuest(id){
				var id_title = \'title_question_\' + id;
				var id_text = \'text_for_question_\' + id;
				var id_post = ' . $post_id . ';
				var title = document.getElementById(id_title).value;
				var text = document.getElementById(id_text).value;
				var ajaxurl = \'' . get_home_url() . '/wp-admin/admin-ajax.php\';
				var data = {
					action: \'wdh_upd\',
					id: id,
					id_post: id_post,
					title: title,
					text: text
				};
				console.log(\'title = \' + title);
				console.log(\'text = \' + text);
				jQuery.post(ajaxurl, data, function (response) {
					console.log(response);
				});
				document.getElementById(\'wdh-quest0\' + id).innerHTML = \'<h4>\' + title + \'</h4><p>\' + text + \'</p>\';
			}
</script>';

			return $txt;
		}
	} else {
		return __('You need to log in', 'wdh-calc');
	}
}
