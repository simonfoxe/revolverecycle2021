<?php
/**
 * Scripts and Styles
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Enqueue
add_action('wp_enqueue_scripts', 'theme_assets');
function theme_assets(){

  /**
   * Stylesheets
   */

  // Main stylesheets
  $slug = 'dms-parent-styles';
  $filename = '/assets/css/style.min.css';
  if ( file_exists( get_template_directory() . $filename )) {
    wp_enqueue_style(
      $slug,
      get_template_directory_uri().$filename,
      array(),
      filemtime( get_template_directory() . $filename )
    );
  }


  /**
   * Scripts
   */
  wp_enqueue_script( 'jquery');

  // Bootstrap
  $slug = 'dms-bootstrap-bundle';
  $filename = '/lib/bootstrap/dist/js/bootstrap.bundle.min.js';
  if ( file_exists( get_template_directory() . $filename )) {
    wp_enqueue_script(
      $slug,
      get_template_directory_uri().$filename,
      array('jquery'),
      filemtime( get_template_directory() . $filename ),
      true
    );
  }

  // AOS
  $slug = 'dms-aos';
  $filename = '/lib/aos/dist/aos.js';
  if ( file_exists( get_template_directory() . $filename )) {
    wp_enqueue_script(
      $slug,
      get_template_directory_uri().$filename,
      array('jquery'),
      filemtime( get_template_directory() . $filename ),
      true
    );
  }


  // Scripts: DMS Parent Scripts
  $slug = 'dms-parent-scripts-head';
  $filename = '/assets/js/scripts-head.min.js';
  if ( file_exists( get_template_directory() . $filename )) {
    wp_enqueue_script(
      $slug,
      get_template_directory_uri().$filename,
      array('jquery'),
      filemtime( get_template_directory() . $filename ),
      false
    );
  }
  $slug = 'dms-parent-scripts-async';
  $filename = '/assets/js/scripts-async.min.js';
  if ( file_exists( get_template_directory() . $filename )) {
    wp_enqueue_script(
      $slug,
      get_template_directory_uri().$filename,
      array('jquery'),
      filemtime( get_template_directory() . $filename ),
      false
    );
    wp_scripts()->add_data( $slug, 'async', true );
  }
  $slug = 'dms-parent-scripts-defer';
  $filename = '/assets/js/scripts-defer.min.js';
  if ( file_exists( get_template_directory() . $filename )) {
    wp_enqueue_script(
      $slug,
      get_template_directory_uri().$filename,
      array('jquery'),
      filemtime( get_template_directory() . $filename ),
      true
    );
    wp_scripts()->add_data( $slug, 'defer', true );
  }

  // Inject JS vars
  wp_localize_script('dms-parent-scripts-head', 'wp_vars', array(
    'ajax_url'  => admin_url( 'admin-ajax.php' ),
    'page_name' => get_the_title()
  ));

  // Comments?
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

}

/**
 * Admin Scripts and Styles
 */
add_action('admin_enqueue_scripts', 'dms_admin_enqueue_scripts');
function dms_admin_enqueue_scripts() {

  // Editor stylesheets
  $slug = 'dms-parent-editor-styles';
  $filename = '/assets/css/custom-editor-style.min.css';
  if ( file_exists( get_stylesheet_directory() . $filename )) {
    wp_enqueue_style(
      $slug,
      get_stylesheet_directory_uri().$filename,
      array(),
      filemtime( get_stylesheet_directory() . $filename )
    );
  }

  // Admin stylesheet
  $slug = 'dms-parent-admin-styles';
  $filename = '/assets/css/admin.min.css';
  if ( file_exists( get_stylesheet_directory() . $filename )) {
    wp_enqueue_style(
      $slug,
      get_stylesheet_directory_uri().$filename,
      array(),
      filemtime( get_stylesheet_directory() . $filename )
    );
  }

  // Admin JS
  $slug = 'dms-parent-admin-js';
  $filename = '/assets/js/scripts-admin.min.js';
  if ( file_exists( get_template_directory() . $filename )) {
    wp_register_script(
      $slug,
      get_template_directory_uri().$filename,
      array(),
      filemtime( get_template_directory() . $filename )
    );
    wp_enqueue_script($slug);
  }

}

