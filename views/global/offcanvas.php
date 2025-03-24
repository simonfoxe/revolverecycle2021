<?php
/**
 * Offcanvas
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div id="offcanvasRight" class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="false" aria-labelledby="offcanvasRightLabel">
	<div class="offcanvas-inner">

	  <div class="offcanvas-header-wrapper">
		  <div class="offcanvas-header-container container">
		  	<div class="offcanvas-header">
			  	<h5 id="offcanvasRightLabel" class="offcanvas-heading my-0"><?php echo apply_filters('dms_offcanvas_right_title', 'Menu'); ?></h5>
				  <button type="button" class="<?php echo apply_filters('dms_offcanvas_btn_close_class', 'btn-offcanvas btn-offcanvas-close btn btn-secondary text-reset'); ?>" data-bs-dismiss="offcanvas" aria-label="Close"><span class="<?php echo apply_filters('dms_offcanvas_btn_close_icon', 'fas fa-times'); ?>"></span><span class="sr-only">Close</span></button>
				</div>
		  </div>
		</div>

		<div class="offcanvas-body-wrapper">
	  	<div class="offcanvas-body-container container">
			  <div class="offcanvas-body">
			  	<div class="offcanvas-body-border"></div>
			  	<?php do_action('offcanvas_body_nav_before'); ?>
			    <?php
			 		// Primary Offcanvas Menu
					if (has_nav_menu( 'header_primary' ) ) {
						?>
						<div class="header_primary">
					  	<?php
					  	$args = array(
								'menu_class'  => 'nav flex-column',
								'walker'      => new WP_Bootstrap_Navwalker_Vertical,
								'fallback_cb' => 'WP_Bootstrap_Navwalker_Vertical::fallback',
								'echo'        => true,
					  	);
					  	dms_get_menu('header_primary', $args);
					  	?>
						</div>
						<?php
					}
					?>
					<?php do_action('offcanvas_body_nav_after'); ?>
				</div>
			</div>
	  </div>

	</div>
</div>