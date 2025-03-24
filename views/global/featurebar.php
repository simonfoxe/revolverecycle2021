<?php
/**
 * Sidebar setup for featurebar
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get the container class
$container = apply_filters('container_class', "container");

global $featurebar_widget_areas;
if ( gf_is_sidebar_active_multiple( 'featurebar-widgets-', $featurebar_widget_areas ) ) :
  ?>
  <div id="wrapper-featurebar" class="wrapper">
    <div id="featurebar" class="featurebar">
      <?php
      for ($i=1; $i <= $featurebar_widget_areas ; $i++) {
        if ( is_active_sidebar('featurebar-widgets-'.$i) ):
          ?>
          <div id="featurebar-widgets-<?php echo $i; ?>" class="featurebar-widget-area" tabindex="-1">
            <?php dynamic_sidebar( 'featurebar-widgets-'.$i ); ?>
          </div>
          <?php
        endif;
      }
      ?>
    </div>
  </div><!-- #wrapper-featurebar -->
  <?php
endif;
