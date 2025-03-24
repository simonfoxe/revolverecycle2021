<?php
/**
 * Content related functions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Scroll to top
add_action('wp_footer', 'dms_scroll_to_top');
if ( !function_exists('dms_scroll_to_top') ):
function dms_scroll_to_top() {
  ?>
  <a href="#" id="toTop" class="show" title="<?php _e('Back to top', 'dms'); ?>">
    <span class="fa-stack fa-2x">
      <i class="totop-background fas fa-circle fa-stack-2x"></i>
      <i class="totop-foreground fa-stack-1x <?php echo apply_filters('dms_totop_icon_classes', 'fas fa-arrow-up'); ?>"></i>
    </span>
  </a>
  <?php
}
endif;