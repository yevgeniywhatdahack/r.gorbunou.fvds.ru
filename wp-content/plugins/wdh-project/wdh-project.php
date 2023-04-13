<?php
/*
 * Plugin main file
 * @package   wdh-project
 * @copyright 2023 Muratshaev DOO
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link      https://muratshaev.me/wdh-project-plugin/
 *
 * @wordpress-plugin
 * Plugin Name:       WDH Project
 * Plugin URI:        https://muratshaev.me/wdh-project-plugin/
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
		load_plugin_textdomain( 'wdh-calc', false, get_home_url() . '/wp-content/plugins/wdh-calc/lang' );
	}
);

/**
 * Add style plugin
 */
add_action( 'wp_enqueue_scripts', 'projects_name_scripts' );
function projects_name_scripts() {
	wp_enqueue_style( 'wdhproject-styles', plugins_url( '/css/style.css', __FILE__ ) );
}

add_shortcode( 'wdhproject', 'wdh_project_shortcode' );

function wdh_project_shortcode( $atts ) {
	global $post;
	global $user;
	$slug = $post->post_name;
	if ( is_user_logged_in() ) {
		$this_user = wp_get_current_user();
		$user_id   = $this_user->ID;

		if ( isset( $_REQUEST['id_project'] ) ) {
			$id_project             = sanitize_text_field( $_REQUEST['id_project'] );
			$project                = get_post( $id_project );
			$project_title          = $project->post_title;
			$stages                 = get_post_meta( $id_project, 'stages', true );
			$date_and_stages        = get_post_meta( $id_project, 'date_and_stages', true );
			$arDates                = explode( ',', $date_and_stages );
			$days_until_the_release = get_post_meta( $id_project, 'days_until_the_release', true );
			$current_status         = get_post_meta( $id_project, 'current_status', true );
			$team                   = get_post_meta( $id_project, 'team', false );
			$budget                 = get_post_meta( $id_project, 'budget', true );
			$budget_expenses        = get_post_meta( $id_project, 'budget_expenses', true );
			$budget_percent         = round( ( $budget_expenses / $budget * 100 ), 2 );

			$txt = '<style>.container-wrap{
				background: #F0F0F9 !important;
			}
			#top{
				background: #fff !important;
			}</style>';
			$txt = $txt . '<div class="row row-stages-title">';
			$txt = $txt . '<div class="col-lg-6"><h2>' . $project_title . '</h2></div>';
			$txt = $txt . '<div class="col-lg-6 link-off"><a href="#" class="btn-off"><img src="' . plugins_url() . '/wdh-calc/img/off.png" title="Log Out" class="log-out-ico">' . __( 'Log out', 'wdh-calc' ) . '</a></div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="row row-stages"><div class="col-lg-12 col-xl-9"><div class="row"><div class="green-title-stages">' . __( 'Stages', 'wdh-calc' ) . '</div></div>';
			$txt = $txt . '<div class="row">';
			$txt = $txt . '<div class="col-lg-12">';
			$txt = $txt . '<div class="band">';
			$txt = $txt . '<div class="title-row">';
			$txt = $txt . '<div class="start-rec come">';
			$txt = $txt . '' . __( 'Start', 'wdh-calc' );
			$txt = $txt . '</div>';
			if ( $stages == 'Discovery' || $stages == 'Development' || $stages == 'Delivery' ) {
				$txt = $txt . '<div class="discovery-rec come">';
				$txt = $txt . '' . __( 'Discovery', 'wdh-calc' );
				$txt = $txt . '</div>';
			} else {
				$txt = $txt . '<div class="discovery-rec">';
				$txt = $txt . '' . __( 'Discovery', 'wdh-calc' );
				$txt = $txt . '</div>';
			}
			if ( $stages == 'Development' || $stages == 'Delivery' ) {
				$txt = $txt . '<div class="development-rec come">';
				$txt = $txt . '' . __( 'Development', 'wdh-calc' );
				$txt = $txt . '</div>';
			} else {
				$txt = $txt . '<div class="development-rec">';
				$txt = $txt . '' . __( 'Development', 'wdh-calc' );
				$txt = $txt . '</div>';
			}
			if ( $stages == 'Delivery' ) {
				$txt = $txt . '<div class="delivery-rec come">';
				$txt = $txt . '' . __( 'Delivery', 'wdh-calc' );
				$txt = $txt . '</div>';
			} else {
				$txt = $txt . '<div class="delivery-rec">';
				$txt = $txt . '' . __( 'Delivery', 'wdh-calc' );
				$txt = $txt . '</div>';
			}
			$txt = $txt . '</div>';
			if ( $stages == 'Start' ) {
				$txt = $txt . '<div class="polosa pw10"></div>';
			}
			if ( $stages == 'Discovery' ) {
				$txt = $txt . '<div class="polosa pw33"></div>';
			}
			if ( $stages == 'Development' ) {
				$txt = $txt . '<div class="polosa pw70"></div>';
			}
			if ( $stages == 'Delivery' ) {
				$txt = $txt . '<div class="polosa pw100"></div>';
			}

			$txt = $txt . '<div class="top-rec">';
			$txt = $txt . '<div class="smsm-band"></div>';
			if ( $stages == 'Discovery' || $stages == 'Development' || $stages == 'Delivery' ) {
				$txt = $txt . '<div class="sector-band act"></div>';
			} else {
				$txt = $txt . '<div class="sector-band"></div>';
			}
			if ( $stages == 'Development' || $stages == 'Delivery' ) {
				$txt = $txt . '<div class="sector-band act"></div>';
			} else {
				$txt = $txt . '<div class="sector-band"></div>';
			}
			if ( $stages == 'Delivery' ) {
				$txt = $txt . '<div class="sector-band act"></div>';
			} else {
				$txt = $txt . '<div class="sector-band"></div>';
			}
			$txt = $txt . '<div class="sector-band-sm"></div>';
			$txt = $txt . '</div>';

			$txt = $txt . '<div class="base-rec"></div>';
			$txt = $txt . '<div class="row-bottom-band">';
			$txt = $txt . '<div class="band-date-1 come">';

			if ( isset( $arDates[0] ) ) {
				$txt = $txt . '' . $arDates[0];
			}

			$txt = $txt . '</div>';
			if ( $stages == 'Discovery' || $stages == 'Development' || $stages == 'Delivery' ) {
				$txt = $txt . '<div class="band-date-2 come">';
				if ( isset( $arDates[1] ) ) {
					$txt = $txt . '' . $arDates[1];
				}
				$txt = $txt . '</div>';
			} else {
				$txt = $txt . '<div class="band-date-2">';
				if ( isset( $arDates[1] ) ) {
					$txt = $txt . '' . $arDates[1];
				}

				$txt = $txt . '</div>';
			}

			if ( $stages == 'Development' || $stages == 'Delivery' ) {
				$txt = $txt . '<div class="band-date-3 come">';
				if ( isset( $arDates[2] ) ) {
					$txt = $txt . '' . $arDates[2];
				}

				$txt = $txt . '</div>';
			} else {
				$txt = $txt . '<div class="band-date-3">';
				if ( isset( $arDates[2] ) ) {
					$txt = $txt . '' . $arDates[2];
				}
				$txt = $txt . '</div>';
			}

			if ( $stages == 'Delivery' ) {
				$txt = $txt . '<div class="band-date-4 come">';
				if ( isset( $arDates[3] ) ) {
					$txt = $txt . '' . $arDates[3];
				}

				$txt = $txt . '</div>';
			} else {
				$txt = $txt . '<div class="band-date-4">';
				if ( isset( $arDates[3] ) ) {
					$txt = $txt . '' . $arDates[3];
				}
				$txt = $txt . '</div>';
			}
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="row row-dash">';
			$txt = $txt . '<div class="col-lg-8">';
			$txt = $txt . '<div class="row">';
			$txt = $txt . '<div class="col-sm-6">';
			$txt = $txt . '<div class="sh-left">';
			$txt = $txt . '<div class="sh-title-left">Days until the release</div>';
			$txt = $txt . '<div class="sh-txt-left">';
			$txt = $txt . '' . $days_until_the_release;
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="col-sm-6">';
			$txt = $txt . '<div class="sh-right">';
			$txt = $txt . '<div class="sh-title-right">Current status</div>';
			$txt = $txt . '<div class="sh-txt-right">';
			$txt = $txt . '' . $current_status;
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';

			$txt = $txt . '<div class="sm-donut">';
			$txt = $txt . '<div class="row">';
			$txt = $txt . '<div class="col-lg-12">';
			$txt = $txt . '<div class="green-budget-title">Budget expenses</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="row row-graph">';
			$txt = $txt . '<div class="col-lg-12" id="graph2">';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';

			$txt   = $txt . '<div class="row row-rep">';
			$txt   = $txt . '<div class="col-lg-12">';
			$txt   = $txt . '<div class="green-reports">Reports</div>';
			$txt   = $txt . '</div>';
			$txt   = $txt . '</div>';
			$txt   = $txt . '<div class="row row-rep-link">';
			$txt   = $txt . '<div class="col-lg-12">';
			$count = 1;

			$args      = array(
				'post_type'      => 'wdhreports',
				'posts_per_page' => -1,
				'meta_query'     => array(
					array(
						'key'   => 'project',
						'value' => $id_project,
					),
				),
				'orderby'        => 'date',
				'order'          => 'ASC',
			);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$title_report = get_the_title( $post->ID );
					$type_report  = get_post_meta( $post->ID, 'type', true );

					$txt = $txt . '<div class="report-link-row">';
					$txt = $txt . '<div class="report-link-number">' . $count . '</div>';
					$txt = $txt . '<div class="report-link-text">';
					$txt = $txt . '<div class="report-in-text">' . $title_report . '</div>';
					if ( $type_report == 'Text' ) {
						$txt = $txt . '<a href="#">';
						$txt = $txt . '<div class="report-link-link">&nbsp;</div>';
						$txt = $txt . '</a>';
					} else {
						$txt = $txt . '<a href="#" target="_blank">';
						$txt = $txt . '<div class="report-link-file">&nbsp;</div>';
						$txt = $txt . '</a>';
					}
					$txt = $txt . '</div>';
					$txt = $txt . '</div>';
					$count++;
				}
			}

			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="col-lg-4">';
			$txt = $txt . '<div class="xl-donut">';
			$txt = $txt . '<div class="row">';
			$txt = $txt . '<div class="col-lg-12">';
			$txt = $txt . '<div class="green-budget-title">Budget expenses</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="row row-graph">';
			$txt = $txt . '<div class="col-lg-12" id="graph">';
			// -------------- Spiner ----------------
			$txt   = $txt . '<script src="https://d3js.org/d3.v5.min.js"></script>';
			$txt   = $txt . '<script>';
			$txt   = $txt . '
			function donut(percent, color, start, end) {
    
				var data = [
					{count: 100 - percent, color: \'#d3d3d3\'},
					{count: percent, color: color},
				  ];
				
				totalPercent = percent + "%";
				//totalPercent = start + " out of " + end;
				
				  var width = 300,
				  height = 300,
				  radius = 150;
			  
					  var arc = d3.arc()
					  .outerRadius(radius - 20)
					  .innerRadius(96);
			  
					  var pie = d3.pie()
					  .sort(null)
					  .value(function(d) {
						  return d.count;
					  });
			  
					  var svg = d3.select(\'#graph\').append("svg")
					  .attr("width", width)
					  .attr("height", height)
					  .append("g")
					  .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
			  
				  var g = svg.selectAll(".arc")
					.data(pie(data))
					.enter().append("g");    
			  
					 g.append("path")
					  .attr("d", arc)
					.style("fill", function(d,i) {
						return d.data.color;
					});
			  
				  g.append("text")
					 .attr("text-anchor", "middle")
					   .attr(\'font-size\', \'4em\')
					   .attr(\'y\', 20)
					 .text(totalPercent);
			  }  ';
			$txt   = $txt . 'donut(' . $budget_percent . ', \'#222329\', ' . $budget_expenses . ', ' . $budget . ');';
			$txt   = $txt . '
			function donut2(percent, color, start, end) {
    
				var data = [
					{count: 100 - percent, color: \'#d3d3d3\'},
					{count: percent, color: color},
				  ];
				
				totalPercent = percent + "%";
				//totalPercent = start + " out of " + end;
				
				  var width = 300,
				  height = 300,
				  radius = 150;
			  
					  var arc = d3.arc()
					  .outerRadius(radius - 20)
					  .innerRadius(96);
			  
					  var pie = d3.pie()
					  .sort(null)
					  .value(function(d) {
						  return d.count;
					  });
			  
					  var svg = d3.select(\'#graph2\').append("svg")
					  .attr("width", width)
					  .attr("height", height)
					  .append("g")
					  .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
			  
				  var g = svg.selectAll(".arc")
					.data(pie(data))
					.enter().append("g");    
			  
					 g.append("path")
					  .attr("d", arc)
					.style("fill", function(d,i) {
						return d.data.color;
					});
			  
				  g.append("text")
					 .attr("text-anchor", "middle")
					   .attr(\'font-size\', \'4em\')
					   .attr(\'y\', 20)
					 .text(totalPercent);
			  }  ';
			  $txt = $txt . 'donut2(' . $budget_percent . ', \'#222329\', ' . $budget_expenses . ', ' . $budget . ');';
			$txt   = $txt . '</script>';

			// -------------- End Spiner ------------
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';

			$txt = $txt . '<div class="xl-team">';
			$txt = $txt . '<div class="row">';
			$txt = $txt . '<div class="col-lg-12">';
			$txt = $txt . '<div class="green-title-teams">';
			$txt = $txt . '' . __( 'The team', 'wdh-calc' );
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="row row-teams">';
			$txt = $txt . '<div class="col-lg-12">';
			$txt = $txt . '<div class="team-space">';
			foreach ( $team[0] as $member ) {
				$job_name  = get_the_title( $member );
				$job_title = get_post_meta( $member, 'job_title', true );
				$photo     = get_post_meta( $member, 'img', true );
				$attr      = array(
					'class' => 'img-team-circle',
				);
				$img       = wp_get_attachment_image( $photo, 'thumb', false, $attr );

				$txt = $txt . '<div class="team-card">';
				$txt = $txt . '<div class="ug-t-l"></div>';
				$txt = $txt . '<div class="ug-b-l"></div>';
				$txt = $txt . '<div class="ug-t-r"></div>';
				$txt = $txt . '<div class="ug-b-r"></div>';
				$txt = $txt . '<div class="team-block">';
				$txt = $txt . '<div class="team-img">';
				$txt = $txt . '' . $img;
				$txt = $txt . '</div>';
				$txt = $txt . '<div class="team-text">';
				$txt = $txt . '<div class="team-title">' . $job_name . '</div>';
				$txt = $txt . '<div class="team-cont">' . $job_title . '</div>';
				$txt = $txt . '</div>';
				$txt = $txt . '</div>';
				$txt = $txt . '</div>';
			}
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';

			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="col-sm-hide col-xl-3">';
			$txt = $txt . '<div class="row">';
			$txt = $txt . '<div class="col-lg-12">';
			$txt = $txt . '<div class="green-title-teams">';
			$txt = $txt . '' . __( 'The team', 'wdh-calc' );
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '<div class="row row-teams">';
			$txt = $txt . '<div class="col-lg-12">';
			$txt = $txt . '<div class="team-space">';
			foreach ( $team[0] as $member ) {
				$job_name  = get_the_title( $member );
				$job_title = get_post_meta( $member, 'job_title', true );
				$photo     = get_post_meta( $member, 'img', true );
				$attr      = array(
					'class' => 'img-team-circle',
				);
				$img       = wp_get_attachment_image( $photo, 'thumb', false, $attr );

				$txt = $txt . '<div class="team-card">';
				$txt = $txt . '<div class="ug-t-l"></div>';
				$txt = $txt . '<div class="ug-b-l"></div>';
				$txt = $txt . '<div class="ug-t-r"></div>';
				$txt = $txt . '<div class="ug-b-r"></div>';
				$txt = $txt . '<div class="team-block">';
				$txt = $txt . '<div class="team-img">';
				$txt = $txt . '' . $img;
				$txt = $txt . '</div>';
				$txt = $txt . '<div class="team-text">';
				$txt = $txt . '<div class="team-title">' . $job_name . '</div>';
				$txt = $txt . '<div class="team-cont">' . $job_title . '</div>';
				$txt = $txt . '</div>';
				$txt = $txt . '</div>';
				$txt = $txt . '</div>';
			}
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';

		} else {
			// No projects
			$txt   = '<div class="container">';
			$txt   = $txt . '<div class="row">';
			$txt   = $txt . '<div class="col-lg-12">';
			$txt   = $txt . '<h2>Questionnaires</h2>';
			$txt   = $txt . '</div>';
			$txt   = $txt . '</div>';
			$txt   = $txt . '<div class="row">';
			$txt   = $txt . '<div class="col-lg-12">';
			$txt   = $txt . '<table class="table">';
			$txt   = $txt . '<thead>';
			$txt   = $txt . '<tr>';
			$txt   = $txt . '<th>Name</th>';
			$txt   = $txt . '<th></th>';
			$txt   = $txt . '</tr>';
			$txt   = $txt . '</thead>';
			$txt   = $txt . '<tbody>';
			$p     = 0;
			$args  = array(
				'post_type'      => 'wdhtypes',
				'posts_per_page' => -1,
				'meta_query'     => array(
					array(
						'key'   => 'user',
						'value' => $user_id,
					),
					array(
						'key'   => 'project',
						'value' => '',
					),
				),
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$txt = $txt . '<tr>';
					$txt = $txt . '<td>' . get_the_title() . '</td>';
					$txt = $txt . '<td><a href="' . get_home_url() . '/poll/?post_id=' . $post->ID . '">' . __( 'View', 'wdh-calc' ) . '</a></td>';
					$txt = $txt . '</tr>';
					$p++;
				}
			}
			if ( $p == 0 ) {
				$txt = $txt = '<tr><td>' . __( 'No data', 'wdh-calc' ) . '</td><td></td></tr>';
			}
			$txt       = $txt . '</tbody>';
			$txt       = $txt . '</table>';
			$txt       = $txt . '</div>';
			$txt       = $txt . '</div>';
			$txt       = $txt . '<div class="row">';
			$txt       = $txt . '<div class="col-lg-12">';
			$txt       = $txt . '<h2>' . __( 'My Projects', 'wdh-calc' );
			$txt       = $txt . '</h2>';
			$txt       = $txt . '</div>';
			$txt       = $txt . '</div>';
			$txt       = $txt . '<div class="row">';
			$txt       = $txt . '<div class="col-lg-12">';
			$txt       = $txt . '<table class="table">';
			$txt       = $txt . '<thead>';
			$txt       = $txt . '<tr>';
			$txt       = $txt . '<th>' . __( 'Name Project', 'wdh-calc' );
			$txt       = $txt . '</th>';
			$txt       = $txt . '<th>' . __( 'Budget', 'wdh-calc' ) . '</th>';
			$txt       = $txt . '</tr>';
			$txt       = $txt . '</thead>';
			$txt       = $txt . '<tbody>';
			$pr        = 0;
			$args      = array(
				'post_type'      => 'wdhproject',
				'posts_per_page' => -1,
				'meta_query'     => array(
					array(
						'key'   => 'owner',
						'value' => $this_user->ID,
					),
				),
			);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$txt = $txt . '<tr>';
					$txt = $txt . '<td><a href="' . get_home_url() . '/' . $slug . '/?id_project=' . $post->ID . '">' . get_the_title( $post->ID ) . '</a></td>';
					$txt = $txt . '<td>' . get_post_meta( $post->ID, 'budget', true ) . '</td>';
					$txt = $txt . '</tr>';
					$pr++;
				}
			}
			if ( $pr == 0 ) {
				$txt = $txt . '<tr><td>' . __( 'No data', 'wdh-calc' ) . '</td><td></td></tr>';
			}
			$txt = $txt . '</tbody>';
			$txt = $txt . '</table>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			$txt = $txt . '</div>';
			// End no projects
		}
	} else {
		$txt = __( 'You are not logged in', 'wdh-calc' );
	}
	return $txt;
}
