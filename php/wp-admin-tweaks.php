<?php

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );    
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

// Disable 'customize' menu in WP-ADMIN
function remove_menus(){
  remove_submenu_page( 'themes.php', 'customize.php' );
}
add_action( 'admin_menu', 'remove_menus' );

// Disable 'post formats' box on WP Admin
function wpse65653_remove_formats()
{
   remove_theme_support('post-formats');
}
add_action('after_setup_theme', 'wpse65653_remove_formats', 100);

// Disable h1, h2 and preformatted from WP Richtext Editor
function wpa_45815($arr){
    $arr['block_formats'] = 'Paragraph=p;Heading 3=h3;Heading 4=h4;Heading 5=h5';
    return $arr;
  }
add_filter('tiny_mce_before_init', 'wpa_45815');

// Add bootstrap html to a native WP video embed
function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="embed-responsive embed-responsive-16by9">'.$html.'</div>';
    return $return;
}
add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

// Remove 'Customise', 'Comments' and 'WP Logo' from the Admin quickbar
function ba_before_admin_bar_render()
{
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('customize');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'wp_before_admin_bar_render', 'ba_before_admin_bar_render' );

/**
 * Set default attachment link to no link
 */
function set_link_type() {
    update_option('image_default_link_type','none');
}
add_action( 'init', 'set_link_type' );
