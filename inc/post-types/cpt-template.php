<?php
/**
 * Custom Post Type Registration
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


if (!function_exists('dms_register_cpt_{slug}')) :
add_action('init', 'dms_register_cpt_{slug}'); // adding the function to the Wordpress init
function dms_register_cpt_{slug}() {
	// Post Type Definition
	$cpt_slug        = "{slug}";  // Singular, slug form
	$cpt_rewrite     = "{slug}s"; // Plural, url form
	$cpt_singular    = __("{slug}", 'gutenflow'); // Singular
	$cpt_plural      = __("{slug}s", 'gutenflow'); // Plural
	$cpt_description = ""; // Description - note this displays in the front end on archive pages
	$cpt_icon        = "dashicons-admin-page"; // https://developer.wordpress.org/resource/dashicons/
	$cpt_admin_menu  = $cpt_plural;

	// Registration
	register_post_type($cpt_slug,
		array(
			'labels' => array(
				'name'                     => $cpt_plural, // This is the Title of the Group
				'singular_name'            => $cpt_singular, // This is the individual type
				'add_new'                  => __('Add New', 'gutenflow').' '.$cpt_singular, // The add new menu item
				'add_new_item'             => __('Add New', 'gutenflow').' '.$cpt_singular, // Add New Display Title
				'edit_item'                => __('Edit', 'gutenflow').' '.$cpt_singular, // Edit Display Title
				'new_item'                 => __('New', 'gutenflow').' '.$cpt_singular, // New Display Title
				'view_item'                => __('View', 'gutenflow').' '.$cpt_singular, // View Display Title
				'view_items'               => __('View', 'gutenflow').' '.$cpt_plural, // View Display Title
				'search_items'             => __('Search', 'gutenflow').' '.$cpt_plural, // Search Custom Type Title
				'not_found'                => __('No items found.', 'gutenflow'), // This displays if there are no entries yet
				'not_found_in_trash'       => __('No items found in Trash', 'gutenflow'), // This displays if there is nothing in the trash
				'parent_item_colon'        => __('Parent', 'gutenflow').' '.$cpt_singular, // Parent item colon
				'all_items'                => __('All', 'gutenflow').' '.$cpt_plural, // the all items menu item
				'archives'                 => $cpt_singular . ' ' . __('Archives', 'gutenflow'), // Archives title
				'attributes'               => $cpt_singular . ' ' . __('Attributes', 'gutenflow'), // Archives title
				'insert_into_item'         => __('Insert into', 'gutenflow').' '.$cpt_singular,
				'uploaded_to_this_item'    => __('Uploaded to this', 'gutenflow').' '.$cpt_singular,
				'filter_items_list'        => __('Filter', 'gutenflow').' '.$cpt_plural.' '.__('list', 'gutenflow'),
				'items_list_navigation'    => $cpt_plural . ' ' . __('list navigation', 'gutenflow'),
				'items_list'               => $cpt_plural . ' ' . __('list', 'gutenflow'),
				'item_published'           => $cpt_singular . ' ' . __('published.', 'gutenflow'),
				'item_published_privately' => $cpt_singular . ' ' . __('published privately.', 'gutenflow'),
				'item_reverted_to_draft'   => $cpt_singular . ' ' . __('reverted to draft.', 'gutenflow'),
				'item_scheduled'           => $cpt_singular . ' ' . __('scheduled.', 'gutenflow'),
				'item_updated'             => $cpt_singular . ' ' . __('updated.', 'gutenflow'),
				'menu_name'                => $cpt_admin_menu, // The admin menu item
			),
			'description'           => $cpt_description, // Custom Type Description
			// Visibility
			'public'                => TRUE,
			'publicly_queryable'    => TRUE,
			'exclude_from_search'   => FALSE,
			'rewrite'               => array('slug' => $cpt_rewrite, 'with_front' => TRUE), // you can specify its url slug
			'query_var'             => TRUE, // Enable query_var /?post_type=slug
			'has_archive'           => $cpt_rewrite, // you can rename the slug here
			// REST API
			'show_in_rest'          => TRUE, // Whether to expose this post type in the REST API
			'rest_base'             => $cpt_rewrite, // Defaults to post type
			'rest_controller_class' => 'WP_REST_Posts_Controller', // Defaults to Posts Controller
			// Admin UI
			'show_ui'               => TRUE,
			'show_in_nav_menus'     => TRUE, // Whether post_type is available for selection in navigation menus.
			'show_in_menu'          => TRUE, // Where to show the post type in the admin menu. show_ui must be TRUE.
			'show_in_admin_bar'     => TRUE, // Whether to make this post type available in the WordPress admin bar.
			'menu_position'         => 30, // this is what order you want it to appear in on the left hand side menu
			'menu_icon'             => $cpt_icon, // the icon for the custom post type menu
			'capability_type'       => 'post',
			'hierarchical'          => FALSE, // Allows you to specify a parent (eg: Pages)
			// Editor Supports - enable or disable features in the editor
			//'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
			'supports'              => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
	 	) // end of options
	); // end of register post type
	// (Optional) This ads regular categories to your custom post type
	//register_taxonomy_for_object_type('category', $cpt_slug);
	// (Optional) This ads regular tags to your custom post type
	//register_taxonomy_for_object_type('post_tag', $cpt_slug);
}
// end function declaration
endif;


/*
// Taxonomies
if (!function_exists('dms_register_cpt_{slug}_taxonomies')) :
add_action( 'init', 'dms_register_cpt_{slug}_taxonomies'); // adding the function to the Wordpress init
function dms_register_cpt_{slug}_taxonomies() {
	$tax_posttypes = array('{slug}');
	$tax_slug      = '{taxonomy_name}';
	$tax_singular  = __('{taxonomy_name}', 'gutenflow');
	$tax_plural    = __('{taxonomy_name}s', 'gutenflow');
	// now let's add custom categories (http://codex.wordpress.org/Function_Reference/register_taxonomy)
	register_taxonomy( $tax_slug,
		$tax_posttypes, // if you change the name of register_post_type( 'custom_type', then you have to change this
		array(
			'labels' => array(
				'name'              => $tax_plural, // name of the custom taxonomy
				'singular_name'     => $tax_singular, // single taxonomy name
				'search_items'      => __('Search', 'gutenflow').' '.$tax_plural, // search titlefor taxomony
				'all_items'         => __('All', 'gutenflow').' '.$tax_plural, // all title for taxonomies
				'parent_item'       => __('Parent', 'gutenflow').' '.$tax_singular, // parent title for taxonomy
				'parent_item_colon' => __('Parent', 'gutenflow').' '.$tax_singular.':', // parent taxonomy title
				'edit_item'         => __('Edit', 'gutenflow').' '.$tax_singular, // edit custom taxonomy title
				'update_item'       => __('Update', 'gutenflow').' '.$tax_singular, // update title for taxonomy
				'add_new_item'      => __('Add New', 'gutenflow').' '.$tax_singular, // add new title for taxonomy
				'new_item_name'     => __('New', 'gutenflow').' '.$tax_singular, // name title for taxonomy
			),
			// Visibility
			'public'                => TRUE,
			'query_var'             => FALSE,
			// Structure
			'hierarchical'          => TRUE,
			'rewrite'               => array(
				'slug'         => $tax_slug,
				'with_front'   => TRUE,
				'hierarchical' => TRUE,
			),
			// Admin UI
			'show_ui'               => TRUE,
			'show_in_quick_edit'    => TRUE,
			'show_tagcloud' 		=> FALSE,
			'show_in_nav_menus'     => TRUE,
			'show_admin_column'     => TRUE,
			// REST API
			'show_in_rest'          => TRUE,
			//'rest_base'             => $tax_slug,
			//'rest_controller_class' => 'WP_REST_Terms_Controller',
		)
	);
}
// end declaration
endif;
*/
