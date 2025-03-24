<?php
/**
 * Navigation Walkers and Menu Rendering
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


class OP_Walker extends Walker_Nav_Menu {

  function start_lvl( &$output, $depth = 0, $args = array(), $id = 0 ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n<div class='expander'>";
    $output .= "</div><ul class='nav__sub-nav'>\n";
  }

  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    global $wp_query;

    $active = '';
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    if(in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes)) {
      $active = 'nav__item-active';
    }

    $class_names = join( ' ', $classes );
    $class = ' class="nav__item '.$active.'  '. $class_names .'"';

    $output .= '<li' . $class .'>';

    $attributes = ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

    $item_output = $args->before;
    $item_output .= '<a class="nav__link" '. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

class OP_Walker_Mobile extends OP_Walker {

  function start_lvl( &$output, $depth = 0, $args = array(), $id = 0 ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n<div class='expander'>";
    $output .= '
    <span class="fa-layers expander-mobile">
      <i class="fa-thin fa-square"></i>
      <i class="dms-expander-icon fa-light fa-plus" data-fa-transform="shrink-7"></i>
    </span>';
    $output .= "</div><ul class='nav__sub-nav'>\n";
  }

}
