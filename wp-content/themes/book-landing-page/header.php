<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Book_Landing_page
 */
	/**
     * Doctype Hook
     * 
     * @hooked book_landing_page_doctype_cb
    */
    do_action( 'book_landing_page_doctype' );
?>
<head itemscope itemtype="">
<?php 
    /**
     * Before wp_head
     * 
     * @hooked book_landing_page_head
    */
    do_action( 'book_landing_page_before_wp_head' );

    wp_head();
    wp_enqueue_style( 'CustomeCss', get_template_directory_uri() . '/css/CustomeCss.css',false,'1.1','all');
?>

</head>

<body <?php body_class(); ?> itemscope itemtype="">

<?php
    /**
     * Before Header
     * 
     * @hooked book_landing_page_page_start - 20 
    */
    do_action( 'book_landing_page_before_header' );
    
    /**
     * Book Landing Page Header
     * 
     * @hooked book_landing_page_header_cb  - 20  
    */
    do_action( 'book_landing_page_header' );
    
    /**
     * Before Content
     * 
     * @hooked book_landing_page_page_header - 20
    */
    do_action( 'book_landing_page_before_content' );
    