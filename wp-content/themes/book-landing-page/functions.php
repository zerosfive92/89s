<?php
/**
 * Book Landing Page functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Book_Landing_page
 */

//define theme version
if ( !defined( 'BOOK_LANDING_PAGE_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();
	
	define ( 'BOOK_LANDING_PAGE_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Implement the Custom functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Implement the WP hooks.
 */
require get_template_directory() . '/inc/wp-hooks.php';

/**
 * Custom template functions for this theme.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Implement the template hooks.
 */
require get_template_directory() . '/inc/template-hooks.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load plugin for right and no sidebar
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/widgets/widgets.php';
/**
 * Woocommerce Custom Function
 */
if( book_landing_page_is_woocommerce_activated() )
require get_template_directory() . '/inc/woocommerce-functions.php';

/**
 * Custom ajax 
 */

/***************** USED action FOR ajax ******************************/
add_action( "wp_ajax_videoswebgetmorevideoadminaction", "video_web_get_more_video_ajax_function" );
add_action( "wp_ajax_nopriv_videoswebgetmorevideoadminaction", "video_web_get_more_video_ajax_function" );

add_action( "wp_ajax_insertdata", "so_wp_insertdata_function" );
add_action( "wp_ajax_nopriv_insertdata", "so_wp_insertdata_function" );

add_action( "wp_ajax_updatevideoaction", "so_wp_update_videos_function" );
add_action( "wp_ajax_nopriv_updatevideoaction", "so_wp_update_videos_function" );

add_action( "wp_ajax_insertvideosadminaction", "so_wp_insert_videos_function" );
add_action( "wp_ajax_nopriv_insertvideosadminaction", "so_wp_insert_videos_function" );

add_action( "wp_ajax_getVideoByIdAction", "video_by_id_function" );
add_action( "wp_ajax_nopriv_getVideoByIdAction", "video_by_id_function" );

function video_web_get_more_video_ajax_function(){
  if(function_exists('PluginGetMoreVideosList')) 
  { 
	PluginGetMoreVideosList($_POST['page']);
  } 

  wp_die(); // ajax call must die to avoid trailing 0 in your response
}

function so_wp_insertdata_function(){

	if(function_exists('InsertBookList')) 
	{ 
		InsertBookList(json_decode(stripslashes($_POST['data'])));
	} 
	wp_die(); // ajax call must die to avoid trailing 0 in your response
}

function so_wp_insert_videos_function(){

	if(function_exists('Insert_videos')) 
	{
		Insert_videos($_POST['data']);
	} 
	wp_die(); // ajax call must die to avoid trailing 0 in your response
}

function so_wp_update_videos_function(){

	if(function_exists('UpdateVideo')) 
	{
		//print_r($_POST['data']);
		UpdateVideo($_POST['data']);
	} 
	wp_die(); // ajax call must die to avoid trailing 0 in your response
}

function video_by_id_function(){
	if(function_exists('Get_Video_By_Id')) 
	{ 
		print_r(Get_Video_By_Id($_POST['id']));
	} 
  
	wp_die(); // ajax call must die to avoid trailing 0 in your response
}