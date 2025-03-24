<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

  /**
  * Feature Bars
  */
  get_template_part('views/global/featurebar', apply_filters('dms_footer_type', ''));


  /**
   * The footer section
   */
  get_template_part('views/global/footer', apply_filters('dms_footer_type', ''));
  ?>

</div><!-- #viewport -->

<?php wp_footer(); ?>
<div id="migration_success"></div>
</body>
</html>