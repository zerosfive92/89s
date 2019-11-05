jQuery(document).ready( function(jQuery){
    console.log("load file successed");
    jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() == jQuery(document).height() - jQuery(window).height()) {
            video_web_load_more_call_ajax();
        }
    });
  });

  function video_web_load_more_call_ajax(){
        var pageMax = jQuery("#hdPageMax").val();
        if(pageMax == 0 || pageMax == "0"){
            var currentPage = jQuery("#hdPage").val();
            var newPage = parseFloat(currentPage) + 1;
            jQuery.ajax({
                url: ajax_object.ajaxurl, // this is the object instantiated in wp_localize_script function
                type: 'POST',
                data:{ 
                action: 'videoswebgetmorevideoadminaction', // this is the function in your functions.php that will be triggered
                page: newPage
                },
                success: function( data ){
                    if(data == 0 || data == "0"){
                        jQuery("#hdPageMax").val(1);
                    }else{      
                        jQuery(".videos-container").append(data);
                        jQuery("#hdPage").val(newPage);
                    }
                }
            });
        }
  }