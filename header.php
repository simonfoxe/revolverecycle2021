<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php the_title(); ?></title>
	<meta name="facebook-domain-verification" content="2rq2z5nr1w3rlqklye1p09n6fokntg" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php
	do_action( 'wp_body_open' );

	// Offcanvas
	get_template_part('views/global/offcanvas');
	?>

	<div id="viewport">

		<?php do_action( 'dms_viewport_open' ); ?>

		<?php
		/**
		 * The header section
		 */

		// Masthead
		get_template_part('views/global/masthead', apply_filters('dms_masthead_type', ''));

		// Navigation
		get_template_part('views/global/navbar', apply_filters('dms_navbar_type', ''));

		// Header Widgets
		get_template_part('views/global/header', apply_filters('dms_header_type', ''));
		?>