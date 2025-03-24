<?php
/**
 * Theme - Master Functions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get the theme data.
$the_theme = wp_get_theme();
define( 'THEME_VERSION', $the_theme->get( 'Version' ) );

global $featurebar_widget_areas;
global $header_widget_areas;
global $masthead_widget_areas;
$masthead_widget_areas = 0;
$header_widget_areas = 0;
$featurebar_widget_areas = 2;

// Register Custom Post Types
require_once 'inc/post-types.php';

// Common functions
include_once 'inc/helpers.php';
include_once 'inc/validation.php';
include_once 'inc/modules/async-defer-scripts/async-defer-scripts.php';
include_once 'inc/navigation/navigation.php';
include_once 'inc/media.php';

// Theme Operations
include_once 'inc/widgets.php';
include_once 'inc/theme-init.php';
include_once 'inc/enqueue.php';
include_once 'inc/brand.php';
include_once 'inc/content.php';

// Modules
include_once 'inc/modules/shortcodes/shortcodes.php';

// Blocks
include_once 'inc/blocks/blocks.php';

// Plugins
include_once 'inc/plugins/plugins.php';


function dequeue_dequeue_plugin_style(){
  //wp_dequeue_style( 'wpsm_counter-font-awesome-front' );
  //wp_dequeue_style( 'wpsm_counter_bootstrap-front' );
  wp_dequeue_script( 'wpsm_count_bootstrap-js-front' );
}
add_action( 'wp_enqueue_scripts', 'dequeue_dequeue_plugin_style', 999 );


/**
 * Show the google embed dropoff map
 */
add_shortcode('dropoff_map', 'show_dropoff_map');
function show_dropoff_map() {
  $output = '
  <div id="dropoff_map" class="responsive-iframe">
    <iframe src="https://www.google.com/maps/d/embed?mid=1cUvpqucojJoxL4SfjQoCJtg0MRCvyX8&ehbc=2E312F" width="640" height="480"></iframe>
  </div>
  ';
  return $output;
}


/**
 * Add social media codes and tags
 */
add_action('wp_footer', 'social_media_codes');
function social_media_codes() {
    ?>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
     fbq('init', '436084531287763'); 
    fbq('track', 'PageView');
    </script>
    <noscript>
     <img height="1" width="1" 
    src="https://www.facebook.com/tr?id=436084531287763&ev=PageView
    &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
    <script type="text/javascript">
    _linkedin_partner_id = "5510412";
    window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
    window._linkedin_data_partner_ids.push(_linkedin_partner_id);
    </script><script type="text/javascript">
    (function(l) {
    if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
    window.lintrk.q=[]}
    var s = document.getElementsByTagName("script")[0];
    var b = document.createElement("script");
    b.type = "text/javascript";b.async = true;
    b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
    s.parentNode.insertBefore(b, s);})(window.lintrk);
    </script>
    <noscript>
    <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=5510412&fmt=gif" />
    </noscript>
    <?php
}


