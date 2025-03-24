<?php
/**
 * Register post types & taxonomies
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Register the post types
$file_includes = array(
  // Post Types
  //'cpt-something.php',
);
foreach ( $file_includes as $file ) {
  require_once get_template_directory() . '/post-types/' . $file;
}
