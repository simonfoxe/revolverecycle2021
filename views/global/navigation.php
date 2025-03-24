<?php
/**
 * Navigation
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<nav class="<?php echo apply_filters('dms_navbar_classes', 'navbar navbar-expand-lg'); ?>">

  <?php
  // Brand Logo / Site Title
  if ( function_exists('dms_navbar_brand')) { dms_navbar_brand(); }
  ?>

  <?php
  if ( !function_exists('dms_navbar_toggle') ):
  function dms_navbar_toggle() {
    ?>
    <button class="<?php echo apply_filters('dms_navbar_toggler_classes', 'btn btn-primary dms-navbar-toggler navbar-toggler'); ?>" type="button" data-dms-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="<?php echo apply_filters('dms_navbar_toggler_icon', 'fas fa-bars'); ?>"></i>
    </button>
    <?php
  }
  endif;

  // Actions
  do_action('dms-navbar-brand-after');
  do_action('dms-navbar-primary-before');


  // Primary navbar
  // If we have a menu assigned to location: primary
  if ( has_nav_menu('header_primary') ):

    // Navbar Toggle
    if ( !function_exists('dms_navbar_toggle') ):
    function dms_navbar_toggle() {
      ?>
      <button class="<?php echo apply_filters('dms_navbar_toggler_classes', 'btn btn-primary dms-navbar-toggler navbar-toggler'); ?>" type="button" data-dms-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-expanded="false" aria-label="Toggle navigation">
        <i class="<?php echo apply_filters('dms_navbar_toggler_icon', 'far fa-bars'); ?>"></i>
      </button>
      <?php
    }
    endif;
    dms_navbar_toggle();

    // Navbar Menu
    if ( !function_exists('dms_navbar_primary') ):
    function dms_navbar_primary() {
      ?>
      <div id="navbar-primary-menu" class="collapse navbar-collapse">
        <?php
        if ( function_exists('dms_get_bootstrap_menu')) {
          $primary_nav_menu_args = array(
            'menu_id'    => 'main-menu',
            'menu_class' => 'navbar-nav ms-auto',
          );
          echo dms_get_bootstrap_menu("header_primary", $primary_nav_menu_args);
        }
        ?>
      </div>
      <?php
    }
    endif;
    dms_navbar_primary();

  endif;


  // Actions
  do_action('dms-navbar-primary-after');
  do_action('dms-navbar-close');
  ?>

</nav>