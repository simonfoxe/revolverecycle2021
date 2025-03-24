<?php
/**
 * Define brand details
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Define the brand color defaults from Bootstrap
$brand_default_colors = array(
	// Primary
	'blue'          => '#0d6efd',
	'indigo'        => '#6610f2',
	'purple'        => '#6f42c1',
	'pink'          => '#d63384',
	'red'           => '#dc3545',
	'orange'        => '#fd7e14',
	'yellow'        => '#ffc107',
	'green'         => '#198754',
	'teal'          => '#20c997',
	'cyan'          => '#0dcaf0',
    // Greyscale colors
	'gray'          => '#d3d3d3',
	'gray-light'    => '#e8e8e8',
	'gray-dark'     => '#8a8a8a',
	'white'         => '#ffffff',
	'black'         => '#000000',
);

// Override the defaults with the brand colors set in the customizer
$brand_colors = get_theme_mod('brand-color-palette') || array();
// Import from child theme JSON
$brand_colors_json_filename = "/source/json/brand-colors.json";
if ( file_exists(get_stylesheet_directory() . $brand_colors_json_filename) ) {
	$brand_colors = json_decode( file_get_contents(get_stylesheet_directory().$brand_colors_json_filename) );
}
// Filter the brand colors
$brand_colors = apply_filters('gf_brand_colors', $brand_colors);


// Write NCA specific variables to Javascript
add_action('wp_footer', 'theme_export_js_variables');
add_action('admin_footer', 'theme_export_js_variables');
function theme_export_js_variables() {
	$theme_vars = array();

	// Add brand colors
	global $brand_colors;
	$theme_vars['brand_colors'] = $brand_colors;

	// Prepare into JSON
	$json = json_encode($theme_vars);
	?>
	<script>var theme_vars = <?php echo $json; ?></script>
	<?php
}


// Add the brand colors to the Gutenberg system color palette
add_action( 'after_setup_theme', 'setup_theme_supported_features' );
function setup_theme_supported_features() {

	// Modify the gutenberg color palette
	global $brand_colors;
	$editor_color_palette = array();
	foreach ($brand_colors as $color_name => $color_hex) {
		$editor_color_palette[] = array(
			'name'  => $color_name,
			'slug'  => $color_name,
			'color' => $color_hex,
		);
	}
  add_theme_support( 'editor-color-palette', $editor_color_palette);

}


// Gutenberg editor font sizes
if (!function_exists('dms_define_font_sizes')):
add_action( 'after_setup_theme', 'dms_define_font_sizes' );
function dms_define_font_sizes() {
  add_theme_support(
    'editor-font-sizes',
    [
      [
        'name' => __( 'Small', 'dms' ),
        'size' => 14,
        'slug' => 'small',
      ],
      [
        'name' => __( 'Medium', 'dms' ),
        'size' => 18,
        'slug' => 'medium',
      ],
      [
        'name' => __( 'Large', 'dms' ),
        'size' => 24,
        'slug' => 'large',
      ],
      [
        'name' => __( 'Extra-large', 'dms' ),
        'size' => 28,
        'slug' => 'extra-large',
      ],
    ]
  );
}
endif;