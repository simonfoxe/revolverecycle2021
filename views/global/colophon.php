<?php
/**
 * Colophon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Construct the copyright
$copyright = get_field('copyright', 'option');

// If copyright does NOT include the symbol, do it ourselves and add the year
if ( strpos($copyright, "©") === FALSE ) {
	$copyright = "© " . date("Y") . " $copyright";
}

// Filter
$copyright = apply_filters( 'dms_copyright', $copyright );

?>
<footer class="colophon">
  <div class="container">
    <div class="colophon-inner">

      <div class="row">
        <div class="col-md-12">
          <?php
          // Hook
          do_action('colophon-inside-before');

          // Colophon Menu
          if (has_nav_menu( 'colophon_menu_1' ) ) {
            ?>
            <div class="colophon_menu text-center">
              <?php echo dms_get_menu('colophon_menu_1'); ?>
            </div>
            <?php
          }

          do_action('colophon-inside-between');

          // Copyright
          if ( $copyright ) {
          	?>
          	<div class='colophon-copyright my-4 text-center'><?= $copyright ?></div>
          	<?php
          }

          do_action('colophon-inside-after');
          ?>
        </div>
      </div><!-- .row -->

    </div>
  </div><!-- .container -->
</footer>