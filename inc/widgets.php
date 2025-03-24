<?php
/**
 * Declaring widgets
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;




add_action( 'widgets_init', 'understrap_widgets_init' );
if ( ! function_exists( 'understrap_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function understrap_widgets_init() {
/*
		// Main Sidebar
		register_sidebar(
			array(
				'name'          => __( 'Right Sidebar', 'gutenflow' ),
				'id'            => 'right-sidebar',
				'description'   => __( 'Right sidebar widget area', 'gutenflow' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);


		register_sidebar(
			array(
				'name'          => __( 'Hero Slider', 'gutenflow' ),
				'id'            => 'hero',
				'description'   => __( 'Hero slider area. Place two or more widgets here and they will slide!', 'gutenflow' ),
				'before_widget' => '<div class="carousel-item">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Hero Canvas', 'gutenflow' ),
				'id'            => 'herocanvas',
				'description'   => __( 'Full size canvas hero area for Bootstrap and other custom HTML markup', 'gutenflow' ),
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Top Full', 'gutenflow' ),
				'id'            => 'statichero',
				'description'   => __( 'Full top widget with dynamic grid', 'gutenflow' ),
				'before_widget' => '<div id="%1$s" class="static-hero-widget %2$s dynamic-classes">',
				'after_widget'  => '</div><!-- .static-hero-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		*/

		// Masthead
		global $masthead_widget_areas;
		$masthead_widget_areas = $masthead_widget_areas ?: 0;
		for ($i=1; $i <= $masthead_widget_areas; $i++) {
			register_sidebar(
				array(
					"name"          => __( "Masthead Bar $i", "understrap" ),
					"id"            => "masthead-widgets-$i",
					"description"   => __( "masthead widget area with dynamic grid", "understrap" ),
					"before_widget" => '<div id="%1$s" class="widget masthead-widget %2$s dynamic-classes">',
					"after_widget"  => "</div><!-- .masthead-widget -->",
					"before_title"  => "<h3 class='widget-title'>",
					"after_title"   => "</h3>",
				)
			);
		}

		// Header
		global $header_widget_areas;
		$header_widget_areas = $header_widget_areas ?: 0;
		for ($i=1; $i <= $header_widget_areas; $i++) {
			register_sidebar(
				array(
					"name"          => __( "Header Bar $i", "understrap" ),
					"id"            => "header-widgets-$i",
					"description"   => __( "Header widget area with dynamic grid", "understrap" ),
					"before_widget" => '<div id="%1$s" class="widget header-widget %2$s dynamic-classes">',
					"after_widget"  => "</div><!-- .header-widget -->",
					"before_title"  => "<h3 class='widget-title'>",
					"after_title"   => "</h3>",
				)
			);
		}

		// Feature Bar
		global $featurebar_widget_areas;
		$featurebar_widget_areas = $featurebar_widget_areas ?: 1;
		for ($i=1; $i <= $featurebar_widget_areas; $i++) {
			register_sidebar(
				array(
					"name"          => __( "Feature Bar $i", "understrap" ),
					"id"            => "featurebar-widgets-$i",
					"description"   => __( "Feature bar widget area with dynamic grid", "understrap" ),
					"before_widget" => '<div id="%1$s" class="widget featurebar-widget %2$s dynamic-classes">',
					"after_widget"  => "</div><!-- .featurebar-widget -->",
					"before_title"  => "<h3 class='widget-title'>",
					"after_title"   => "</h3>",
				)
			);
		}

		// Footer
		global $footer_widget_areas;
		$footer_widget_areas = $footer_widget_areas ?: 1;
		for ($i=1; $i <= $footer_widget_areas; $i++) {
			register_sidebar(
				array(
					"name"          => __( "Footer $i", "understrap" ),
					"id"            => "footer-widgets-$i",
					"description"   => __( "Footer widget area with dynamic grid", "understrap" ),
					"before_widget" => '<div id="%1$s" class="widget footer-widget %2$s dynamic-classes">',
					"after_widget"  => "</div><!-- .footer-widget -->",
					"before_title"  => "<h3 class='widget-title'>",
					"after_title"   => "</h3>",
				)
			);
		}

	}
} // endif function_exists( 'understrap_widgets_init' ).


// Custom function to check multiple interated sidebar areas for active
function gf_is_sidebar_active_multiple($sidebar_prefix, $sidebar_count) {
	if ( $sidebar_prefix && $sidebar_count && is_numeric($sidebar_count) ) {
		for ($i=1; $i <= $sidebar_count ; $i++) {
			if ( is_active_sidebar($sidebar_prefix.$i) ) {
				return true;
			}
		}
	}
	return false;
}