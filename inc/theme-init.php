<?php
/**
 * Theme Init
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// After Setup Theme
add_action( 'after_setup_theme', 'dms_after_setup_theme' );
if ( !function_exists( 'dms_after_setup_theme' ) ):
function dms_after_setup_theme() {

  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on understrap, use a find and replace
   * to change 'gutenflow' to the name of your theme in all the template files
   */
  load_theme_textdomain( 'dms', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'script',
    'style',
  ) );

  // Support feature images
  add_theme_support( 'post-thumbnails' );

  // Add support for responsive embedded content.
  add_theme_support( 'responsive-embeds' );

  // Support new block templates WP5.8+
  add_theme_support( 'block-templates' );

  // Set up the WordPress Theme logo feature.
  add_theme_support( 'custom-logo' );

  // Add bootstrap XL size image thumbnail
  add_image_size('xl', '1200', '9999');

  // Pages get excerpts
  add_post_type_support('page', 'excerpt');

  // Wide gutenberg blocks
  add_theme_support( 'align-wide' );

  // Add theme support for selective refresh for widgets.
  add_theme_support( 'customize-selective-refresh-widgets' );

  // Register Menu Locations
  $locations = apply_filters('dms_menu_locations', array(
    'header_primary'  => __('Header Primary'),
    'footer_menu_1'   => __('Footer')." 1",
    'colophon_menu_1' => __('Colophon')." 1",
  ));
  register_nav_menus( $locations );

}
endif;



// WordPress Init
add_action('init', 'dms_wp_init');
if (!function_exists("dms_wp_init")):
function dms_wp_init() {



}
endif;



// Disable emojis
add_action('init', 'disable_wp_emojicons');
if (!function_exists("disable_wp_emojicons")):
function disable_wp_emojicons() {
  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}
endif;



/**
 * ACF Init
 */
add_action('acf/init', 'dms_acf_init');
function dms_acf_init() {

  if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
    acf_add_options_sub_page('General');
  }

}

// Load JSON paths from both Parent and Child
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths = array() ) {
  $paths = array( get_template_directory() . '/source/acf-json' );
  if ( is_child_theme() ) {
    $paths[] = get_stylesheet_directory() . '/source/acf-json';
  }
  return $paths;
}

// Save JSON paths to child theme
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path = '' ) {
  $path = get_template_directory() . '/source/acf-json';
  if ( is_child_theme() ) {
    $path = get_stylesheet_directory() . '/source/acf-json';
  }
  return $path;
}



/**
 * REST API
 */
// This filter will limit the access of the REST API
add_filter('rest_authentication_errors', 'dms_rest_authentication_errors');
function dms_rest_authentication_errors($result) {
  if ( ! empty( $result ) ) {
    return $result;
  }
  if ( ! is_user_logged_in() && !current_user_can('administrator') ) {
    return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
  }
  return $result;
}


/**
 * Media
 */

// Add extra attributes to YouTube embeds
add_filter('embed_oembed_html', 'custom_youtube_querystring', 10, 4);
function custom_youtube_querystring( $html, $url, $attr, $post_id ) {
  if (strpos($html, 'youtube')!= FALSE || strpos($html, 'youtu.be') != FALSE) {
    $args = [
      'rel' => 0,
      'showinfo' => 0,
      //'controls' => 0,
      'modestbranding' => 1,
    ];
    $params = '?feature=oembed&';
    foreach ($args as $arg => $value) {
      $params .= $arg;
      $params .= '=';
      $params .= $value;
      $params .= '&';
    }
    $html = str_replace( '?feature=oembed', $params, $html );
  }
  return $html;
}


/**
 * Content
 */

// Check whether to display a page title
function dms_show_page_title() {
  global $post;
  $show_page_title = true;
  if ( is_front_page() ) {
    $show_page_title = false;
  }
  return apply_filters('dms_show_page_title', $show_page_title);
}


// Reusable blocks;
add_action( 'admin_menu', 'linked_url' );
function linked_url() {
add_menu_page( 'linked_url', 'Reusable Blocks', 'read', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
}