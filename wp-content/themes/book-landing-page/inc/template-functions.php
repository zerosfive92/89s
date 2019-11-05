<?php
/**
 * Custom template function for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Book_Landing_Page
 */


if( ! function_exists( 'book_landing_page_doctype_cb' ) ) :
/**
 * Doctype Declaration
 * 
 * @since 1.0.1
*/
function book_landing_page_doctype_cb(){
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;

if( ! function_exists( 'book_landing_page_head' ) ) :
/**
 * Before wp_head
 * 
 * @since 1.0.1
*/
function book_landing_page_head(){
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
}
endif;

if( ! function_exists( 'book_landing_page_page_start' ) ) :
/**
 * Page Start
 * 
 * @since 1.0.1
*/
function book_landing_page_page_start(){
    ?>
    <div id="page" class="site">
    <?php
}
endif;

if( ! function_exists( 'book_landing_page_header_cb' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function book_landing_page_header_cb(){
    ?>
    <header id="masthead" class="site-header" role="banner" itemscope itemtype="">
      <div class="container">
        <div class="site-branding" itemscope itemtype="">
              <?php 
                  if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                      the_custom_logo();
                  } 
              ?>
               <div class="text-logo">
                    <?php if ( is_front_page() ) : ?>
                        <!---<h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                    <?php endif; 
                      $description = get_bloginfo( 'description', 'display' );
                      if ( $description || is_customize_preview() ) : ?>
                      <p class="site-description" itemprop="description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>-->
              <?php
              endif; ?>
        </div>
      </div><!-- .site-branding -->
      
      <div id="menu-opener">
          <span></span>
          <span></span>
          <span></span>
      </div>
      <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="">
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
      </nav><!-- #site-navigation -->
      </div>
    </header><!-- #masthead -->
    <?php 
}
endif;

if( ! function_exists( 'book_landing_page_breadcrumbs_cb' ) ) :
/**
 * Book Landing Page Breadcrumb
 * 
 * @since 1.0.1
*/

function book_landing_page_breadcrumbs_cb() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = esc_html( get_theme_mod( 'book_landing_page_breadcrumb_separator', __( '>', 'book-landing-page' ) ) ); // delimiter between crumbs
  $home = esc_html( get_theme_mod( 'book_landing_page_breadcrumb_home_text', __( 'Home', 'book-landing-page' ) ) ); // text for the 'Home' link
  $showCurrent = get_theme_mod( 'book_landing_page_ed_current', '1' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
  $ed_breadcrumb = get_theme_mod( 'book_landing_page_ed_breadcrumb' );
 
  global $post;
  $homeLink = esc_url( home_url() );
  
  if( $ed_breadcrumb ){
     
    if ( is_front_page()) {
   
      if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
   
    } else {
 
    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . single_cat_title('', false) . $after;
 
    } elseif ( is_search() ) {
      echo $before . esc_html__( 'Search Result', 'book-landing-page' ) . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a> ' . $delimiter . ' ';
      echo '<a href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '">' . esc_html( get_the_time('F') ) . '</a> ' . $delimiter . ' ';
      echo $before . esc_html( get_the_time('d') ) . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a> ' . $delimiter . ' ';
      echo $before . esc_html( get_the_time('F') ) . $after;
 
    } elseif ( is_year() ) {
      echo $before . esc_html( get_the_time('Y') ) . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . esc_html( $post_type->labels->singular_name ) . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html( get_the_title() ) . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . esc_html( get_the_title() ) . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . esc_html( $post_type->labels->singular_name ) . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . esc_url( get_permalink($parent) ) . '">' . esc_html( $parent->post_title ) . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html( get_the_title() ) . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . esc_html( get_the_title() ) . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html( get_the_title() ) . $after;
 
    } elseif ( is_tag() ) {
      echo $before . esc_html( single_tag_title('', false) ) . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . esc_html( $userdata->display_name ) . $after;
 
    } elseif ( is_404() ) {
        echo $before . esc_html__( '404 Error - Page not Found', 'book-landing-page' ) . $after;
    } elseif( is_home() ){
        echo $before;
        single_post_title();
        echo $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __( 'Page', 'book-landing-page' ) . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }  

} 
}// end book_landing_page_breadcrumbs()

endif;

if( ! function_exists( 'book_landing_page_page_header' ) ) :
/**
 * Page Header for inner pages
 * 
 * @since 1.0.1
*/
function book_landing_page_page_header(){   

    if( !( is_front_page() ||  is_page_template( 'template-home.php' ) ) ) {
      $ed_breadcrumb = get_theme_mod( 'book_landing_page_ed_breadcrumb' );
      if( $ed_breadcrumb ){
        echo '<div class="breadcrumbs"><div class="container">'; 
            do_action( 'book_landing_page_breadcrumbs');
        echo '</div></div>';
      }
      echo '<div class="container">';
           
        if( is_search() ){ 
          echo '<header class="page-header"><h1 class="page-title">';
            printf( esc_html__( 'Search Results for %s', 'book-landing-page' ), '<span>' . get_search_query() . '</span>' ); 
          echo '</h1></header>';

        }elseif ( is_home() ) {
          echo '<div class="page-header"><h1 class="page-title">';
            single_post_title();
          echo '</h1></div>';

        }elseif ( is_archive() ){ 
            if( book_landing_page_woocommerce_activated() ){ 
                if( is_shop() ){
                    echo false; 
                }else{
                    echo '<header class="page-header">';
                      the_archive_title( '<h1 class="page-title">', '</h1>' );
                    echo '</header>';  
                }   
            }else{ 
                  echo '<header class="page-header">';
      				      the_archive_title( '<h1 class="page-title">', '</h1>' );
                  echo '</header>';
            }
        }
      echo '</div>';
      }
      $ed_section = book_landing_page_ed_section();

      if( is_home() || ! $ed_section || ! ( is_front_page()  || is_page_template( 'template-home.php' ) ) ){
          echo '<div class="container content-container">';
          if( !is_404() ){ 
          echo '<div id="content" class="site-content">'; 
            echo '<div class="row">';   
              echo '<div id="primary" class="content-area">';
          }else{
              echo '<div class="error-holder">';   
          } 
      }
} 

endif;

if( ! function_exists( 'book_landing_page_page_content_image' ) ) :
/**
 * Page Featured Image
 * 
 * @since 1.0.1
*/
function book_landing_page_page_content_image(){
    $sidebar_layout = book_landing_page_sidebar_layout();
    if( has_post_thumbnail() )
    ( is_active_sidebar( 'right-sidebar' ) && ( $sidebar_layout == 'right-sidebar' ) ) ? the_post_thumbnail( 'book-landing-page-with-sidebar' ) : the_post_thumbnail( 'book-landing-page-without-sidebar' );    
}
endif;


if( ! function_exists( 'book_landing_page_post_content_image' ) ) :
/**
 * Post Featured Image
 * 
 * @since 1.0.1
*/
function book_landing_page_post_content_image(){
    if( has_post_thumbnail() ){
    echo ( !is_single() ) ? '<a href="' . esc_url( get_the_permalink() ) . '" class="post-thumbnail">' : '<div class="post-thumbnail">'; 
         ( is_active_sidebar( 'right-sidebar' ) ) ? the_post_thumbnail( 'book-landing-page-with-sidebar', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'book-landing-page-without-sidebar', array( 'itemprop' => 'image' ) ) ; 
    echo ( !is_single() ) ? '</a>' : '</div>' ;    
    }
}
endif;

if( ! function_exists( 'book_landing_page_post_entry_header' ) ) :
/**
 * Post Entry Header
 * 
 * @since 1.0.1
*/
function book_landing_page_post_entry_header(){
    ?>
    <header class="entry-header">
        <?php
            if ( is_single() ) {
                the_title( '<h3 class="entry-title "><i class="fas fa-angle-double-right"></i>">', '</h3>' );
            } else {
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }   
        ?>
    </header><!-- .entry-header -->
    <?php
}
endif;

if( ! function_exists( 'book_landing_page_post_author' ) ) :
/**
 * Post Author Bio
 * 
 * @since 1.0.1
*/
function book_landing_page_post_author(){
    if( get_the_author_meta( 'description' ) ){
        global $post;
    ?>
    <section class="author">
        <h2 class="title"><?php esc_html_e( 'About Admin', 'book-landing-page' ); ?></h2>
        <div class="holder">
        <div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 126 ); ?></div>
            <div class="text-holder">
                <strong class="name"><?php echo esc_html( get_the_author_meta( 'display_name', $post->post_author ) ); ?></strong>
                <?php book_landing_page_posted_on(); ?>
                <?php echo wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ); ?>
            </div>
        </div>
    </section>
    <?php  
    }  
}
endif;

if( ! function_exists( 'book_landing_page_get_comment_section' ) ) :
/**
 * Comment template
 * 
 * @since 1.0.1
*/
function book_landing_page_get_comment_section(){
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;
}
endif;

if( ! function_exists( 'book_landing_page_content_end' ) ) :
/**
 * Content End
 * 
 * @since 1.0.1
*/
function book_landing_page_content_end(){
    $ed_section = book_landing_page_ed_section();
    if( is_home() || ! $ed_section || ! ( is_front_page()  || is_page_template( 'template-home.php' ) ) ){
      if( !is_404() ){
          echo '</div>'; 
          echo '</div>';
          echo '</div>'; 
      }    
      echo '</div>';// .row /#content /.container
    }
}
endif;

if( ! function_exists( 'book_landing_page_footer_start' ) ) :
/**
 * Footer Start
 * 
 * @since 1.0.1
*/
function book_landing_page_footer_start(){
    echo '<footer id="colophon" class="site-footer" role="contentinfo" itemscope>';
    echo '<div class="container">';
}
endif;


if( ! function_exists( 'book_landing_page_footer_menu' ) ) :
/**
 * Footer Bottom
 * 
 * @since 1.0.1 
*/
function book_landing_page_footer_menu(){
    if ( has_nav_menu( 'secondary' ) ) {
        echo '<nav class="widget-nav-links" id="footer-navigation" role="navigation" itemscope>';
            wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'fallback_cb'  => false, ) ); 
        echo '</nav>'; // #site-navigation
    }
}
endif;

if( ! function_exists( 'book_landing_page_footer_credit' ) ) :
/**
 * Footer Credits 
 */
function book_landing_page_footer_credit(){
  $copyright_text = get_theme_mod( 'book_landing_page_footer_copyright_text' );
  echo '<div class="site-info">';
    if( $copyright_text ){
      echo wp_kses_post( $copyright_text ); 
    }else{
      esc_html_e( 'Copyright &copy;&nbsp;', 'book-landing-page' ); 
      echo date_i18n( esc_html__( 'Y', 'book-landing-page' ) );
      echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) );
      echo '&#46;&nbsp;</a>';
    }
    
    //printf( '<a href="%1$s"> Book Landing Page By %2$s</a>&#46;&nbsp;', esc_url( __( 'https://raratheme.com/wordpress-themes/book-landing-page/', 'book-landing-page' ) ), 'Rara Theme' );
    
    //printf( esc_html__( 'Powered by %s ', 'book-landing-page' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'book-landing-page' ) ) .'" target="_blank">WordPress&#46;</a>' );
    if ( function_exists( 'the_privacy_policy_link' ) ) {
        the_privacy_policy_link();
    }
  echo '</div>';

}
endif;

if( ! function_exists( 'book_landing_page_footer_end' ) ) :
/**
 * Footer End
 * 
 * @since 1.0.1 
*/
function book_landing_page_footer_end(){
    echo '</div>';
    echo '</footer>'; // #colophon 
    echo '<div class="overlay"></div>';
}
endif;

if( ! function_exists( 'book_landing_page_page_end' ) ) :
/**
 * Page End
 * 
 * @since 1.0.1
*/
function book_landing_page_page_end(){
    ?>
    </div><!-- #page -->
    <?php
}
endif;
