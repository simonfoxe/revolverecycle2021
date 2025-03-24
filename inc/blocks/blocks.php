<?php
/**
 * Block registration
 */

add_action('acf/init', 'dms_acf_register_blocks', 20);
if ( !function_exists('dms_acf_register_blocks')):
function dms_acf_register_blocks() {
  if (function_exists('acf_register_block')) {

    /**
     * Sections
     */

    /*
    acf_register_block(array(
      'name'            => 'dms-section',
      'title'           => __('DMS Section'),
      'description'     => __('A section within a page that can contain other blocks'),
      'render_callback' => 'flexible_content_blocks_render_callback',
      'category'        => 'dms-sections',
      'icon'            => 'slides',
      'mode'            => 'preview',
      'keywords'        => array('dms', 'section'),
      'supports'        => array(
        'anchor' => true,
        'align' => true,
        'mode' => false,
        'jsx' => true
      ),
    ));
    */

  }
}
endif;

// Block callback to view templates
function flexible_content_blocks_render_callback($block) {
  $slug = str_replace('acf/', '', $block['name']);
  if (file_exists(get_theme_file_path("/views/blocks/{$slug}.php"))) {
    include(get_theme_file_path("/views/blocks/{$slug}.php"));
  }
}

/**
 * Custom Block Categories
 */
// Note: filter 'block_categories' deprecated in 5.8+
// https://developer.wordpress.org/reference/hooks/block_categories_all/
if ( version_compare( $GLOBALS['wp_version'], '5.8-alpha-1', '<' ) ) {
  add_filter( 'block_categories', 'custom_block_categories', 10, 2 );
} else {
  add_filter( 'block_categories_all', 'custom_block_categories', 10, 2 );
}
function custom_block_categories( $categories, $post ) {
  return $categories;
  /*
  return array_merge(
    $categories,
    array(
      array(
        'slug' => 'dms-sections',
        'title' => 'DMS Sections',
      ),
      array(
        'slug' => 'dms-calculators',
        'title' => 'DMS Calculators',
      ),
    )
  );
  */
}

