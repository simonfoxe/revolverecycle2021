<?php
/**
 * Navigation filters, navwalkers and updates
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Include the Bootstrap Nav Walker
include_once 'class-wp-bootstrap-navwalker.php';
include_once 'class-wp-bootstrap-navwalker-vertical.php';

/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
  if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
    if ( array_key_exists( 'data-toggle', $atts ) ) {
      unset( $atts['data-toggle'] );
      $atts['data-bs-toggle'] = 'dropdown';
    }
  }
  return $atts;
}


// Navbar Brand Logo / Site Title
if (!function_exists('dms_navbar_brand')):
function dms_navbar_brand() {
  $icon = get_field('company_logo_navbar', 'option');
  $site_title = apply_filters('dms_site_title', get_bloginfo());
  ?>
  <a class="navbar-brand" href="<?php echo get_home_url(); ?>" title="<?= $site_title; ?>"><img src="<?php echo $icon['url']; ?>" alt="<?= $site_title; ?>" /></a>
  <?php
}
endif;


// Primary Menu
if (!function_exists('dms_menu_header_primary')):
function dms_menu_header_primary() {
  wp_nav_menu(array(
    'theme_location'  => 'header_primary',
    'container'       => '',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => apply_filters('dms_navbar_menu_classes', 'navbar-nav ms-auto mb-2 mb-lg-0'),
    'walker'          => new WP_Bootstrap_Navwalker(),
    'fallback_cb'     => 'WP_Bootstrap_Dropdown_Navwalker::fallback',
    'menu_id'         => 'main-menu',
    'depth'           => 4,
    'cache'           => true,
  ));
}
endif;


// Get Bootstrap Menu
if (!function_exists('dms_get_bootstrap_menu')):
function dms_get_bootstrap_menu($menu_location, $args = array()) {
  $defaults = array(
    'theme_location'  => $menu_location,
    'container'       => '',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => 'navbar-nav',
    'walker'          => new WP_Bootstrap_Navwalker(),
    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
    'menu_id'         => '',
    'echo'            => false,
    'depth'           => 4,
    'cache'           => true,
  );
  $args = wp_parse_args( $args, $defaults );

  // Filter
  $args = apply_filters('dms_get_bootstrap_menu', $args, $menu_location);

  // Get menu
  if ( $args['echo'] ) {
    wp_nav_menu($args);
  } else {
    return wp_nav_menu($args);
  }

}
endif;


// Get Menu
if (!function_exists('dms_get_menu')):
function dms_get_menu($menu_location, $args = array()) {
  $defaults = array(
    'theme_location'  => $menu_location,
    'container'       => '',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => '',
    'fallback_cb'     => '',
    'walker'          => '',
    'menu_id'         => '',
    'echo'            => false,
    'depth'           => 4,
    'cache'           => true,
  );
  $args = wp_parse_args( $args, $defaults );

  // Filter
  $args = apply_filters('dms_get_menu', $args, $menu_location);

  // Get menu
  if ( $args['echo'] ) {
    wp_nav_menu($args);
  } else {
    return wp_nav_menu($args);
  }

}
endif;


// Optional caret handler for submenu items
add_filter('nav_menu_item_title', 'dms_nav_menu_item_title', 10, 4);
function dms_nav_menu_item_title($title, $item, $args, $depth) {
  if ( in_array("menu-item-has-children", $item->classes) ) {
    $title .= "<span class='nav-caret'><i class='fas fa-angle-down'></i></span>";
  }
  return $title;
}