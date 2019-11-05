<?php
function get_videos_Web_Controller($page){
	$recordNumber = 4;
	$pageNumber = $page * $recordNumber;
    global $wpdb;
	$table_name = $wpdb->prefix . "videos"; 
	$getresults = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY UpdateDate DESC LIMIT $pageNumber, $recordNumber" );
	return $getresults;
}

?>