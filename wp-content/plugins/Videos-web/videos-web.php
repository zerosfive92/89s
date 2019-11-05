<?php
/*
Plugin Name:  Videos web
Plugin URI: .com.vn
Description: Plugin load videos cho website .com.vn
Version: 1.0
Author: Lapdc
Author URI: https://.com.vn
License: GPL
*/
require_once('controllers/VideosWebController.php');



if(!function_exists('PluginGetVideosList')){
	function PluginGetVideosList(){

        wp_register_style( 'boostrap4css', plugins_url() . '/videos-web/lib/bootstrap.min.css' );
        wp_enqueue_style( 'boostrap4css' );
        wp_register_style( 'videosWebStyle', plugins_url() . '/videos-web/css/videos-web-style.css' );
        wp_enqueue_style( 'videosWebStyle' );

        wp_register_script('boostrap4js', plugins_url() . '/videos-web/lib/bootstrap.min.js');
        wp_enqueue_script('boostrap4js');

        wp_enqueue_script('videos-web-ajax', plugins_url() . '/videos-web/js/videosweb.ajax.js');
        wp_localize_script('videos-web-ajax', 'videosWebAjax', array(
            'pluginsUrl' => plugins_url(),
        ));
        wp_localize_script( 'videos-web-ajax', 'ajax_object', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));

		?>
			<div class="container videos-container">
				<!--<div class="row">
                    <div class="col-12">
                        <h2>Danh sách videos</h2>
                    </div>
                </div>-->
                <input type="hidden" id="hdPage" value="0" />
                <input type="hidden" id="hdPageMax" value="0" />
                <?php 
                $videosList = get_videos_Web_Controller(0);
                if(count($videosList) > 0){
                    $countNo = 1;
                    foreach($videosList as &$value){
                        $itemClass = "";
                        if($countNo%2) {
                            $itemClass =  "videos-item-odd d-flex flex-row";
                        }else{
                            $itemClass =  "videos-item-even d-flex flex-row-reverse";
                        }
                        ?>
                            
                            <div class="row videos-item <?php echo $itemClass ?>">
                                <div class="col-12 col-md-6">
                                    <div class="col-12 videos-item-vid">
                                        <div class="col-12">
                                            <iframe width="1280" height="250" src="<?php echo $value -> Url ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 videos-item-des">
                                    <div class="col-12 videos-item-des-title">
                                        <h3><?php echo $value -> Title ?></h3>
                                    </div>
                                    <div class="col-12 videos-item-des-info">
                                        <span class="small-label">Ngày tạo: <span><span class="small-text-content"><?php echo date_format(date_create($value -> PublishDate),"d/m/Y") ?></span>
                                    </div>
                                    <div class="col-12 videos-item-des-content">
                                        <p><?php echo substr($value -> Description, 0,300) . "..." ?><p>
                                    </div>
                                    <div class="col-12" style="text-align: right;">
                                        <a data-toggle="modal" data-target="#myModal<?php echo $value -> Id ?>">
                                           >>> Xem thêm</a>
                                    </div>
                                </div>
                                <div class="modal fade" id="myModal<?php echo $value -> Id ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <?php echo $value -> Description ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        $countNo ++;
                    }
                }else{
                    ?>
                        <div class="row videos-item">
                            <div class="col-12 d-flex justify-content-center">
                                <span class="small-text-content">No video</span>
                            </div>
                        </div>
                    <?php
                }
                ?>
            </div>
		<?php
	}
	add_shortcode('shortcode_VideosList', 'PluginGetVideosList');
}

function PluginGetMoreVideosList($page){
    $videosList = get_videos_Web_Controller($page);
    if(count($videosList) > 0){
        $countNo = 1;
        foreach($videosList as &$value){
            $itemClass = "";
            if($countNo%2) {
                $itemClass =  "videos-item-odd d-flex flex-row";
            }else{
                $itemClass =  "videos-item-even d-flex flex-row-reverse";
            }
            ?>
                
                <div class="row videos-item <?php echo $itemClass ?>">
                    <div class="col-12 col-md-6">
                        <div class="col-12 videos-item-vid">
                            <div class="col-12">
                                <iframe width="1280" height="250" src="<?php echo $value -> Url ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 videos-item-des">
                        <div class="col-12 videos-item-des-title">
                            <h3><?php echo $value -> Title ?></h3>
                        </div>
                        <div class="col-12 videos-item-des-info">
                            <span class="small-label">Ngày tạo: <span><span class="small-text-content"><?php echo date_format(date_create($value -> PublishDate),"d/m/Y") ?></span>
                        </div>
                        <div class="col-12 videos-item-des-content">
                            <p><?php echo substr($value -> Description, 0,300) . "..." ?><p>
                        </div>
                        <div class="col-12" style="text-align: right;">
                            <a data-toggle="modal" data-target="#myModal<?php echo $value -> Id ?>">
                                >>> Xem thêm</a>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal<?php echo $value -> Id ?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <?php echo $value -> Description ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            $countNo ++;
        }
    }else{
        print_r(0);
    }
}


function Get_ajax_param($name, $age){
    echo "name: ".$name." - age: " .$age;
}

if(!function_exists('PluginGetContentIndexPage')){
	function PluginGetContentIndexPage(){

        wp_register_style( 'boostrap4css', plugins_url() . '/videos-web/lib/bootstrap.min.css' );
        wp_enqueue_style( 'boostrap4css' );
        wp_register_style( 'videosWebStyle', plugins_url() . '/videos-web/css/videos-web-style.css' );
        wp_enqueue_style( 'videosWebStyle' );

        wp_register_script('boostrap4js', plugins_url() . '/videos-web/lib/bootstrap.min.js');
        wp_enqueue_script('boostrap4js');

		?>
			<div class="container">
				<div class="row">
                    <div class="col-12">
                        <h3>Videos mới</h3>
                    </div>
                </div>
                <?php 
                $videosList = get_videos_Web_Controller(0);
                if(count($videosList) > 0){
                    $countNo = 1;
                    foreach($videosList as &$value){
                        $itemClass = "";
                        if($countNo%2) {
                            $itemClass =  "videos-item-odd d-flex flex-row";
                        }else{
                            $itemClass =  "videos-item-even d-flex flex-row-reverse";
                        }
                        ?>
                            
                            <div class="row videos-item <?php echo $itemClass ?>">
                                <div class="col-12 col-md-6">
                                    <div class="col-12 videos-item-vid">
                                        <div class="col-12">
                                            <iframe width="1280" height="250" src="<?php echo $value -> Url ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 videos-item-des">
                                    <div class="col-12 videos-item-des-title">
                                        <h3><?php echo $value -> Title ?></h3>
                                    </div>
                                    <div class="col-12 videos-item-des-info">
                                        <span class="small-label">Ngày tạo: <span><span class="small-text-content"><?php echo date_format(date_create($value -> PublishDate),"d/m/Y") ?></span>
                                    </div>
                                    <div class="col-12 videos-item-des-content">
                                        <p><?php echo substr($value -> Description, 0,300) . "..." ?><p>
                                    </div>
                                    <div class="col-12" style="text-align: right;">
                                        <a data-toggle="modal" data-target="#myModal<?php echo $value -> Id ?>">
                                           >>> Xem thêm</a>
                                    </div>
                                </div>
                                <div class="modal fade" id="myModal<?php echo $value -> Id ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <?php echo $value -> Description ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        $countNo ++;
                    }
                }else{
                    ?>
                        <div class="row videos-item">
                            <div class="col-12 d-flex justify-content-center">
                                <span class="small-text-content">No video</span>
                            </div>
                        </div>
                    <?php
                }
                ?>
            </div>
            <div class="container section-container">
				<div class="row">
                    <div class="col-12">
                        <h3>Talents</h3>
                    </div>
                </div>
                <div class="row videos-item">
                    <div class="col-12 d-flex justify-content-center">
                        <span class="small-text-content">Coming soon...</span>
                    </div>
                </div>
            </div>
		<?php
	}
	add_shortcode('shortcode_IndexContent', 'PluginGetContentIndexPage');
}

if(!function_exists('PluginGetContentfooter')){
	function PluginGetContentfooter(){

        wp_register_style( 'boostrap4css', phplugins_url() . '/videos-web/lib/bootstrap.min.css' );
        wp_enqueue_style( 'boostrap4css' );
        wp_register_style( 'videosWebStyle', plugins_url() . '/videos-web/css/videos-web-style.css' );
        wp_enqueue_style( 'videosWebStyle' );

        wp_register_script('boostrap4js', plugins_url() . '/videos-web/lib/bootstrap.min.js');
        wp_enqueue_script('boostrap4js');

		?>
			<div class="row">
                <div class="col-12 col-md-4">
                    <img src="<?php echo plugins_url() . '/videos-web/includes/logo_89s_100.png'?>">
                </div>
                <div class="col-12 col-md-8">
                    <p>Copyright © 2019 89s. </p>
                </div>
            </div>
		<?php
	}
	add_shortcode('shortcode_footercontent', 'PluginGetContentfooter');
}

?>