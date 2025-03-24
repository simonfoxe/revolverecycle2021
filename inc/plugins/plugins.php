<?php
/**
 * Plugin Mods
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Register the post types
$file_includes = array(
  // Post Types
  'gravityforms/gravityforms.php',
);
foreach ( $file_includes as $file ) {
  require_once get_template_directory() . '/inc/plugins/' . $file;
}
