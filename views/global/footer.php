<?php
/**
 * Footer
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get the container class
$container = apply_filters('container_class', "container");

// Get optional ACF fields
$company_logo     = get_field('company_logo_footer', 'option');
$company_logo2    = get_field('company_logo_footer2', 'option');
$company_logo2_link = get_field('company_logo_footer2_link', 'option');
$company_phone    = get_field('company_phone', 'option');
$company_email    = get_field('company_email', 'option');
$company_address  = get_field('company_address', 'option');
$open_hours       = get_field('open_hours', 'option');
$app_store_link   = get_field('apple_app_store_url', 'option');
$play_store_link  = get_field('google_play_store_url', 'option');
$social_facebook  = get_field('social_facebook', 'option');
$social_twitter   = get_field('social_twitter', 'option');
$social_linkedin  = get_field('social_linkedin', 'option');
$social_youtube   = get_field('social_youtube', 'option');
$social_instagram = get_field('social_instagram', 'option');
?>

<footer class="app-footer">
  <div class="container">
    <div class="row justify-content-between">

      <div class="col-sm-6">

        <div class="row mb-4">

          <div class="col-sm-auto">
            <?php
            if ( isset($company_logo['url']) && $company_logo['url']):
              // Filter the footer logo
              $company_logo = apply_filters('dms_footer_logo', $company_logo);
              ?>
              <a class="footer-logo" href="<?php echo home_url(); ?>">
                <img class="mb-3" src="<?php echo $company_logo['url'] ?>" loading="lazy" alt="<?php echo get_bloginfo(); ?>" width="180" height="156" >
              </a>
            <?php endif; ?>
          </div>

          <div class="col-sm-auto">
            <?php
            if ( isset($company_logo2['url']) && $company_logo2['url']):
              // Filter the footer logo
              $company_logo2 = apply_filters('dms_footer_logo', $company_logo2);
              $link_url = isset($company_logo2_link['url']) && $company_logo2_link['url'] ? $company_logo2_link['url'] : "#";
              $link_target = isset($company_logo2_link['target']) && $company_logo2_link['target'] ? $company_logo2_link['target'] : "";
              ?>
              <a class="footer-logo" href="<?= $link_url; ?>" target="<?= $link_target; ?>">
                <img class="mb-3" src="<?php echo $company_logo2['url'] ?>" loading="lazy" alt="<?php echo get_bloginfo(); ?>" width="180" height="156" >
              </a>
            <?php endif; ?>
          </div>

        </div>

        <div class="row mb-4">

          <div class="col-sm-auto">
            Powered by:<br />
            <a class="footer-logo" href="https://www.bingoindustries.com.au/" target="_blank">
              <img class="mb-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-bingo-transparent.png" loading="lazy" alt="Bingo Industries" width="180" height="70">
            </a>
          </div>

          <div class="col-sm-6">
            <a class="footer-logo" href="" target="_blank">
              <img class="mb-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ACNC-Registered-Charity-Logo_RGB.png" loading="lazy" alt="ACNC-Registered-Charity" width="100" height="100">
            </a>
          </div>

        </div>

      </div>

      <?php
      if ( $company_email || $company_phone || $company_address ):
        ?>
        <div class="col-auto">
          <div class="footer-contact-details mb-5">
            <h4 id="contact" class="has-white-color mt-0 mb-3">Contact</h4>
            <?php
            if ( $company_email ) {
              ?>
              <div class="footer-contact-detail footer-contact-detail-email"><i class="footer-contact-detail-icon fas fa-fw mr-4 fa-envelope"></i><a href="mailto:<?php echo $company_email; ?>" target="_blank"><?php echo $company_email; ?></a></div>
              <?php
            }
            if ( $company_phone ) {
              ?>
              <div class="footer-contact-detail footer-contact-detail-phone"><i class="footer-contact-detail-icon fas fa-fw mr-4 fa-phone"></i><a href="tel:<?php echo $company_phone; ?>" target="_blank"><?php echo $company_phone; ?></a></div>
              <?php
            }
            if ( $company_address ) {
              ?>
              <div class="footer-contact-detail footer-contact-detail-address"><i class="footer-contact-detail-icon fas fa-fw mr-4 fa-map-marker"></i><?php echo $company_address; ?></div>
              <?php
            }

            if ( $open_hours ) {
              ?>
              <div class="footer-contact-detail footer-contact-detail-address mt-2"><i class="footer-contact-detail-icon fas fa-fw mr-4 fa-clock"></i><div><?php echo $open_hours; ?></div></div>
              <?php
            }
            ?>



            <?php
            if ( $social_facebook || $social_twitter || $social_linkedin || $social_youtube || $social_instagram ):
              ?>
              <div class="footer-social-icons my-4 mx-n2">
                <?php if ( $social_facebook ): ?>
                  <a href="<?= $social_facebook; ?>" target="_blank" title="Facebook"><i class="fab fa-facebook fa-3x mx-2"></i></a>
                <?php endif; ?>
                <?php if ( $social_twitter ): ?>
                  <a href="<?= $social_twitter; ?>" target="_blank" title="Twitter"><i class="fab fa-twitter fa-3x mx-2"></i></a>
                <?php endif; ?>
                <?php if ( $social_linkedin ): ?>
                  <a href="<?= $social_linkedin; ?>" target="_blank" title="Linkedin"><i class="fab fa-linkedin fa-3x mx-2"></i></a>
                <?php endif; ?>
                <?php if ( $social_youtube ): ?>
                  <a href="<?= $social_youtube; ?>" target="_blank" title="Youtube"><i class="fab fa-youtube fa-3x mx-2"></i></a>
                <?php endif; ?>
                <?php if ( $social_instagram ): ?>
                  <a href="<?= $social_instagram; ?>" target="_blank" title="Instagram"><i class="fab fa-instagram fa-3x mx-2"></i></a>
                <?php endif; ?>
              </div>
            <?php endif; ?>

          </div>
        </div>
      <?php endif; ?>

      <?php
      // Footer Menus
      if (has_nav_menu( 'footer_menu_1' ) ) {
        ?>
        <div class="col-auto">
          <div class="footer_menu">
          <h4 class="mt-0"><?php echo wp_get_nav_menu_name('footer_menu_1');?></h4>
          <?php echo dms_get_menu('footer_menu_1'); ?>
          </div>
        </div>
        <?php
      }
      ?>

    </div><!-- .row -->

    <?php
    global $footer_widget_areas;
    if ( gf_is_sidebar_active_multiple( 'footer-widgets-', $footer_widget_areas ) ) :
      for ($i=1; $i <= $footer_widget_areas ; $i++) {
        if ( is_active_sidebar('footer-widgets-'.$i) ):
          ?>
          <div id="footer-widgets-<?php echo $i; ?>" class="footer-widget-area" tabindex="-1">
            <?php dynamic_sidebar( 'footer-widgets-'.$i ); ?>
          </div>
          <?php
        endif;
      }
    endif;
    ?>

  </div><!-- .container -->
</footer>


<?php
/**
 * Colophon
 */
get_template_part('views/global/colophon', get_post_type() );


