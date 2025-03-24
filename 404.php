<?php
/**
 * The template for displaying the 404 template in the Twenty Twenty theme.
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get the container class
$container = apply_filters('container_class', "container");;

get_header();
?>
<div id="content-wrapper" class="content-wrapper">

	<?php do_action('content-outside-before'); ?>

	<div id="content" class="<?php echo esc_attr( $container ); ?>" tabindex="-1">

		<?php do_action('content-inside-before'); ?>

		<div class="row">

			<div id="primary" class="col-md content-area">

				<?php do_action('main-outside-before'); ?>

				<main class="site-main" id="main" role="main">

					<?php do_action('main-inside-before'); ?>


					<article class="section-inner error404-content" id="error404-content">

						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Page Not Found' ); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content clearfix">

							<div class="intro-text"><p><?php _e( 'The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.' ); ?></p></div>

							<?php
							get_search_form(
								array(
									'label' => __( '404 not found' ),
								)
							);
							?>

						</div><!-- .entry-content -->

						<footer class="entry-footer">
						</footer><!-- .entry-footer -->

					</article><!-- #post-<?php the_ID(); ?> -->

					<?php do_action('main-inside-after'); ?>

					<div id="main-end"></div>

				</main><!-- #main -->

				<?php do_action('main-outside-after'); ?>

			</div><!-- #primary -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'views/sidebar/sidebar', 'right' ); ?>

		</div><!-- .row -->

		<?php do_action('content-inside-after'); ?>

	</div><!-- #content -->

	<?php do_action('content-outside-after'); ?>

</div><!-- #page-wrapper -->

<?php get_footer();
