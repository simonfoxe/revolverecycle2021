<?php
/**
 * Header
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<header class="app-header sticky-top">
	<div class="container">

		<?php
		do_action('dms-app-header-open');

		/**
		 * Navigation
		 */
		$display_navigation = apply_filters('dms_display_navigation', (isset($args['display_navigation']) && $args['display_navigation'] === false) ? false : true);
		if ( $display_navigation ):
			get_template_part('views/global/navigation');
		endif;

		do_action('dms-app-header-close');
		?>

	</div>
</header>